<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sebelum extends Model
{
    use HasFactory;
    protected $table = 'sebelum';
    protected $guarded = ['id'];
}
