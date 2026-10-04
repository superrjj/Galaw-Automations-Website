<?php

namespace App\Services;

use App\Enums\InquiryStatus;
use App\Mail\InquiryConfirmation;
use App\Mail\InquirySubmitted;
use App\Models\Inquiry;
use App\Models\InquiryAttachment;
use App\Services\Ai\InquiryAnalyzer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Throwable;

class InquiryService
{
    public function __construct(
        private InquiryAnalyzer $analyzer,
    ) {}

    /**
     * @param  array<string, mixed>  $data
     * @param  array<int, UploadedFile>  $attachments
     */
    public function submit(array $data, array $attachments = []): Inquiry
    {
        return DB::transaction(function () use ($data, $attachments): Inquiry {
            $inquiry = Inquiry::query()->create([
                ...$data,
                'status' => InquiryStatus::New,
            ]);

            foreach ($attachments as $file) {
                $this->storeAttachment($inquiry, $file);
            }

            $this->sendNotifications($inquiry);
            $this->analyzeWithAi($inquiry);

            return $inquiry->fresh(['service', 'attachments']);
        });
    }

    private function storeAttachment(Inquiry $inquiry, UploadedFile $file): InquiryAttachment
    {
        $disk = config('filesystems.default', 'local');
        $path = $file->store('inquiry-attachments/'.$inquiry->id, $disk);

        return $inquiry->attachments()->create([
            'original_name' => $file->getClientOriginalName(),
            'path' => $path,
            'disk' => $disk,
            'mime_type' => $file->getClientMimeType(),
            'file_size' => $file->getSize() ?: 0,
        ]);
    }

    private function sendNotifications(Inquiry $inquiry): void
    {
        $adminEmail = app(SiteSettings::class)->get('admin_notification_email')
            ?: config('mail.from.address');

        try {
            if ($adminEmail) {
                Mail::to($adminEmail)->send(new InquirySubmitted($inquiry));
            }

            Mail::to($inquiry->email)->send(new InquiryConfirmation($inquiry));
        } catch (Throwable $exception) {
            report($exception);
        }
    }

    private function analyzeWithAi(Inquiry $inquiry): void
    {
        try {
            $analysis = $this->analyzer->analyze($inquiry);

            if ($analysis !== null) {
                $inquiry->update([
                    'ai_analysis' => $analysis,
                    'ai_analyzed_at' => now(),
                ]);
            }
        } catch (Throwable $exception) {
            report($exception);
        }
    }
}
