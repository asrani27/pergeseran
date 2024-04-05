<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunciRekening extends Model
{
    use HasFactory;
    protected $table = 'kunci_rekening';
    protected $guarded = ['id'];
    public $timestamps = false;
}
