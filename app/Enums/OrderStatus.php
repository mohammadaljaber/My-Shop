<?php

namespace App\Enums;

enum OrderStatus:int
{
    case DRAFT = 1;
    case PAYMENT_FAILED = 2;
    case PAID = 3;
    case COMPLETED = 4;
}
