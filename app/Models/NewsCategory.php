<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class NewsCategory extends Pivot
{

    protected $fillable = [
        'news_id',
        'category_id',
    ];
}