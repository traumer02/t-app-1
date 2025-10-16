<?php

namespace App\Models;

use App\Enums\Models\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    protected $table = 'news';

    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'author_id',
        'published_at',
    ];

}
