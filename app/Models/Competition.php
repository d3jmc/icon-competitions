<?php

namespace App\Models;

use App\Enums\CompetitionStatus;
use App\Enums\TicketType;
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

    /**
     * @return HasMany
     */
    public function instantWinTickets(): HasMany
    {
        return $this->tickets()->where('type', TicketType::INSTANT_WIN);
    }
}
