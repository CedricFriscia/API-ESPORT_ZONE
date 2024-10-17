<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Maize\Markable\Markable;
use Maize\Markable\Models\Bookmark;

class Article extends Model
{
    use HasApiTokens, HasFactory, Markable;

    protected $fillable = [
        'name', 
        'content',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static $marks = [
        Bookmark::class,
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_articles')
                    ->withTimestamps();
    }
}