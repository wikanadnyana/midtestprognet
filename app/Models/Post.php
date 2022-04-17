<?php

namespace App\Models;
use App\Models\KategoriPost;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'image', 'writer_id', 'title', 'content'
    ];

    public function writer()
    {
        return $this->belongsTo(Writer::class);

    }
    public function kategoriposts()
    {
        return $this->hasMany(KategoriPost::class);
    }

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'kategori_posts', 'post_id', 'kategori_id');
    }
}
