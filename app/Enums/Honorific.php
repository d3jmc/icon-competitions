<?php

namespace App\Enums;

enum Honorific: string
{
    case MR = 'Mr';
    case MRS = 'Mrs';
    case MISS = 'Miss';
    case MS = 'Ms';
    case MX = 'Mx';
    case SIR = 'Sir';
    case DAME = 'Dame';
    case DR = 'Dr';
    case CLLR = 'Cllr';
    case LADY = 'Lady';
    case LORD = 'Lord';
    case OTHER = 'Other';
}