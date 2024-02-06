<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ourservice extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description'
    ];

}