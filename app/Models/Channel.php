<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['id', 'title', 'slug', 'color'];
    use HasFactory;
}
