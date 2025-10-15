<?php

namespace App\Models;

use App\Enums\Models\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    use HasFactory;

    protected $fillable = [
        'customer_id',
        'subject',
        'text',
        'status',
        'response_at',
    ];

    protected $casts = [
        'status' => Status::class,
    ];
}
