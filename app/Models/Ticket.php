<?php

namespace App\Models;

use App\Enums\TicketStatus;
use App\Enums\TicketType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'type' => TicketType::class,
            'status' => TicketStatus::class,
        ];
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
