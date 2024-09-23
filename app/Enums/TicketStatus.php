<?php

namespace App\Enums;

enum TicketStatus: string
{
    case UNCLAIMED = 'unclaimed';
    case RESERVED = 'reserved';
    case CLAIMED = 'claimed';
    case VOIDED = 'voided';
}