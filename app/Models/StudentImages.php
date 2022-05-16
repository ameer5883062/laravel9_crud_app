<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentImages extends Model
{
    use HasFactory;

    /**
     * The model's Table & Fields name
     *
     */
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $fillable =
    [
        'student_id',
        'image',
        'default_image'
    ];
}
