<?php

namespace App\Models;

use Database\Factories\InquiryAttachmentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

#[Fillable([
    'inquiry_id',
    'original_name',
    'path',
    'disk',
    'mime_type',
    'file_size',
])]
class InquiryAttachment extends Model
{
    /** @use HasFactory<InquiryAttachmentFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return [
            'file_size' => 'integer',
        ];
    }

    public function inquiry(): BelongsTo
    {
        return $this->belongsTo(Inquiry::class);
    }

    public function url(): ?string
    {
        return Storage::disk($this->disk)->exists($this->path)
            ? Storage::disk($this->disk)->url($this->path)
            : null;
    }
}
