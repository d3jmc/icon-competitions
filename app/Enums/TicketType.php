<?php

namespace App\Enums;

enum TicketType: string
{
    case STANDARD = 'standard';
    case INSTANT_WIN = 'instant_win';
}