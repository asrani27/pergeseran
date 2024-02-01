<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuan';
    protected $guarded = ['id'];

    public function detail()
    {
        return $this->hasMany(PerubahanRekening::class, 'pengajuan_id');
    }

    public function sebelum()
    {
        return $this->hasMany(Sebelum::class, 'pengajuan_id');
    }

    public function sesudah()
    {
        return $this->hasMany(Sesudah::class, 'pengajuan_id');
    }

    public function skpd()
    {
        return $this->belongsTo(Skpd::class, 'skpd_id');
    }
}
