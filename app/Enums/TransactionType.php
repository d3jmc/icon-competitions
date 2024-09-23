<?php

namespace App\Enums;

enum TransactionType: string
{
    case DEPOSIT = 'deposit';
    case CREDIT = 'credit';
    case WITHDRAWAL = 'withdrawal';
}