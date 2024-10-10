<?php

namespace App\Models;

use App\Enums\CompetitionStatus;
use App\Events\CompetitionEnded;
use App\Events\CompetitionStarted;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competition extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'thumbnail',
        'start_date',
        'started_on',
        'end_date',
        'ended_on',
        'ticket_price',
        'min_tickets',
        'max_tickets',
        'min_tickets_per_user',
        'max_tickets_per_user',
        'instant_wins',
        'status',
    ];

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
     * @return Attribute
     */
    protected function ticketPrice(): Attribute
    {
        return Attribute::make(
            get: fn (float $value) => number_format($value, 2),
        );
    }

    /**
     * @return bool
     */
    public function isDraft(): bool
    {
        return ($this->status === CompetitionStatus::DRAFT);
    }

    /**
     * @return bool
     */
    public function isScheduled(): bool
    {
        return ($this->status === CompetitionStatus::SCHEDULED);
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return ($this->status === CompetitionStatus::ACTIVE);
    }

    /**
     * @return bool
     */
    public function isFinished(): bool
    {
        return ($this->status === CompetitionStatus::FINISHED);
    }

    /**
     * @return void
     */
    public function start(): void
    {
        $this->update([
            'started_on' => now(),
            'status' => CompetitionStatus::ACTIVE,
        ]);

        event(new CompetitionStarted($this));
    }

    /**
     * @return void
     */
    public function end(): void
    {
        $this->update([
            'ended_on' => now(),
            'status' => CompetitionStatus::FINISHED,
        ]);
        
        event(new CompetitionEnded($this));
    }

    /**
     * @return int
     */
    public function percentageOfClaimedTickets(): int
    {
        return round(($this->tickets()->claimed()->count() / $this->max_tickets) * 100);
    }

    /**
     * @param  Builder $query
     *
     * @return void
     */
    public function scopeDraft(Builder $query): void
    {
        $query->where('status', CompetitionStatus::DRAFT);
    }

    /**
     * @param  Builder $query
     *
     * @return void
     */
    public function scopeScheduled(Builder $query): void
    {
        $query->where('status', CompetitionStatus::SCHEDULED);
    }

    /**
     * @param  Builder $query
     *
     * @return void
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('status', CompetitionStatus::ACTIVE);
    }

    /**
     * @param  Builder $query
     *
     * @return void
     */
    public function scopeFinished(Builder $query): void
    {
        $query->where('status', CompetitionStatus::FINISHED);
    }

    /**
     * @param  Builder $query
     *
     * @return void
     */
    public function scopePastStartDate(Builder $query): void
    {
        $query->where('start_date', '<=', now());
    }

    /**
     * @param  Builder $query
     *
     * @return void
     */
    public function scopePastEndDate(Builder $query): void
    {
        $query->where('end_date', '<=', now());
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
