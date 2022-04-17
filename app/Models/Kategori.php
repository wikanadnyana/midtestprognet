<?php

namespace App\Models;
use App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori'
    ];

    public function kategoriposts()
    {
        return $this->hasMany(KategoriPost::class);
    }

    public function posts()
    {
        return $this->belongsTo(Post::class, 'kategori_posts');
    }
}
