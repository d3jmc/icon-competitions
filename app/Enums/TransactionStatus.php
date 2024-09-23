<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case PENDING = 'pending';
    case COMPLETE = 'complete';
    case ERROR = 'error';
    case REJECTED = 'rejected';
}