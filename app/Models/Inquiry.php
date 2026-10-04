<?php

namespace App\Models;

use App\Enums\InquiryStatus;
use Database\Factories\InquiryFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'service_id',
    'name',
    'email',
    'phone',
    'company',
    'project_title',
    'description',
    'budget',
    'timeline',
    'additional_requirements',
    'status',
    'admin_notes',
    'ai_analysis',
    'ai_analyzed_at',
])]
class Inquiry extends Model
{
    /** @use HasFactory<InquiryFactory> */
    use HasFactory;

    protected $attributes = [
        'status' => 'new',
    ];

    protected function casts(): array
    {
        return [
            'status' => InquiryStatus::class,
            'ai_analysis' => 'array',
            'ai_analyzed_at' => 'datetime',
        ];
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(InquiryAttachment::class);
    }

    public function scopeStatus(Builder $query, InquiryStatus|string $status): Builder
    {
        $value = $status instanceof InquiryStatus ? $status->value : $status;

        return $query->where('status', $value);
    }

    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (blank($term)) {
            return $query;
        }

        return $query->where(function (Builder $builder) use ($term): void {
            $builder->where('name', 'like', "%{$term}%")
                ->orWhere('email', 'like', "%{$term}%")
                ->orWhere('company', 'like', "%{$term}%")
                ->orWhere('project_title', 'like', "%{$term}%");
        });
    }
}
