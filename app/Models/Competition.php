<?php

namespace App\Models;

use App\Enums\CompetitionStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competition extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @return array
     */
    protected function casts(): array
    {
        return [
            'status' => CompetitionStatus::class,
        ];
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeDraft(Builder $query): void
    {
        $query->where('status', CompetitionStatus::DRAFT);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeScheduled(Builder $query): void
    {
        $query->where('status', CompetitionStatus::SCHEDULED);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('status', CompetitionStatus::ACTIVE);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeFinished(Builder $query): void
    {
        $query->where('status', CompetitionStatus::FINISHED);
    }

    /**
     * @return HasMany
     */
    public function prizes(): HasMany
    {
        return $this->hasMany(Prize::class);
    }

    /**
     * @return HasMany
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
