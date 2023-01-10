<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'cat_name',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
