<?php

namespace App\Models;

use App\Enums\TicketType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prize extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * @return array
     */
    protected function casts(): array
    {
        return [
            'assign_to_ticket_type' => TicketType::class,
        ];
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopeAssignable(Builder $query): void
    {
        $query->whereRaw('prizes.available > prizes.assigned');
    }

    /**
     * @param Builder $query
     * @param TicketType $ticketType
     * @return void
     */
    public function scopeForTicketType(Builder $query, TicketType $ticketType): void
    {
        $query->where('assign_to_ticket_type', $ticketType);
    }

    /**
     * @return BelongsTo
     */
    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class);
    }
}
