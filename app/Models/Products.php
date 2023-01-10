<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'img_file_path',
        'price',
        'created_at',
        'updated_at',
    ];

    public function orders()
    {
        return $this->belongsToMany(Orders::class);
    }
}
