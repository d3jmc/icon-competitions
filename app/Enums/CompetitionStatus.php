<?php

namespace App\Enums;

enum CompetitionStatus: string
{
    case DRAFT = 'draft';
    case SCHEDULED = 'scheduled';
    case ACTIVE = 'active';
    case FINISHED = 'finished';
}