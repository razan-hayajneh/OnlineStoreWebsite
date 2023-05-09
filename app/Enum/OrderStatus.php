<?php

namespace App\Enum;

enum OrderStatus: string
{
    case CREATED = 'created';
    case ACCEPTED = 'accepted';
    case PENDING = 'pending';
    case ONWAY = 'on-way';
    case ARRIVED = 'arrived';
    case FINISHED = 'finished';
    case DELAYED = 'delayed';
    case TIMEOUT = 'timeOut';
    case REJECTED = 'rejected';

}
