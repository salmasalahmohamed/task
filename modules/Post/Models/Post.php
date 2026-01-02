<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $fillable = [
        'id',
        'title',
        'content',
        'status',
        'category_id'
        ,'published_at',
    ];
    public function category() {
        return $this->belongsTo(Category::class);}
    protected $casts = [
        'published_at' => 'datetime',
    ];
}
