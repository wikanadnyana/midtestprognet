<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    use HasFactory;
    protected $fillable = [
        'writer'
    ];

    public function post()
    {
        return $this->hasMany(Post::class);
    }
}
