<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'img_file_path',
        'content',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
