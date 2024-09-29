<?php

namespace App\Models;

use App\Enums\CompetitionStatus;
use App\Events\CompetitionEnded;
use App\Events\CompetitionStarted;
use App\Exceptions\HandleCompetitionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competition extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
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
     * @param bool $force
     * @return void
     */
    public function start(bool $force = false): void
    {
        if (!$force && $this->status !== CompetitionStatus::SCHEDULED) {
            throw new HandleCompetitionException('The competition must be scheduled before starting.');
        }

        $this->update([
            'started_on' => now(),
            'status' => CompetitionStatus::ACTIVE,
        ]);

        event(new CompetitionStarted($this));
    }

    /**
     * @param bool $force
     * @return void
     */
    public function end(bool $force = false): void
    {
        if (!$force && $this->status !== CompetitionStatus::ACTIVE) {
            throw new HandleCompetitionException('The competition must be active before ending.');
        }

        $this->update([
            'ended_on' => now(),
            'status' => CompetitionStatus::FINISHED,
        ]);
        
        event(new CompetitionEnded($this));
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
