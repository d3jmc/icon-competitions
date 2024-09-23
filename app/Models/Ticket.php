<?php

namespace App\Models;

use App\Enums\TicketStatus;
use App\Enums\TicketType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @return array
     */
    protected function casts(): array
    {
        return [
            'type' => TicketType::class,
            'status' => TicketStatus::class,
        ];
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeStandard(Builder $query): void
    {
        $query->where('type', TicketType::STANDARD);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeInstantWin(Builder $query): void
    {
        $query->where('type', TicketType::INSTANT_WIN);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeUnclaimed(Builder $query): void
    {
        $query->where('status', TicketStatus::UNCLAIMED);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeReserved(Builder $query): void
    {
        $query->where('status', TicketStatus::RESERVED);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeClaimed(Builder $query): void
    {
        $query->where('status', TicketStatus::CLAIMED);
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeVoided(Builder $query): void
    {
        $query->where('status', TicketStatus::VOIDED);
    }

    /**
     * @return BelongsTo
     */
    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }

    /**
     * @return BelongsTo
     */
    public function prize(): BelongsTo
    {
        return $this->belongsTo(Prize::class);
    }
}
