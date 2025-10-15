<?php

namespace App\Enums\Models;

enum Status: int
{

    case New = 0;
    case Pending = 1;
    case Approved = 2;
}
