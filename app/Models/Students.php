<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sudent extends Model
{
    use HasFactory;

    /**
     * The model's Table name
     *
     */
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $fillable =
    [
        'name',
        'father_name',
        'contact_no',
        'email_address',
        'address',
        'gender',
        'image',
        'default_image'
    ];
}
