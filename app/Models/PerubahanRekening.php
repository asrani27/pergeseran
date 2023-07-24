<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerubahanRekening extends Model
{
    use HasFactory;
    protected $table = 'perubahan_rekening';
    protected $guarded = ['id'];
    public $timestamps = false;
}
