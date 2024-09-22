<?php

namespace App\Enums;

enum AddressType: string
{
    case PRIMARY = 'primary';
    case SECONDARY = 'secondary';
    case BILLING = 'billing';
    case SHIPPING = 'shipping';
}