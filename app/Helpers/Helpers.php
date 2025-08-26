<?php

use Carbon\Carbon;
use App\Models\Timer;
use App\Models\Satuan;
use App\Models\Setting;
use App\Models\JenisRfk;
use App\Models\BatasInput;
use App\Models\RekeningBelanja;
use App\Models\SSH;
use Illuminate\Support\Facades\Auth;

function namaProgram($kode)
{
    return RekeningBelanja::where('kode_program', $kode)->first() == null ? null : RekeningBelanja::where('kode_program', $kode)->first()->nama_program;
}
function namaKegiatan($kode)
{
    return RekeningBelanja::where('kode_kegiatan', $kode)->first() == null ? null : RekeningBelanja::where('kode_kegiatan', $kode)->first()->nama_kegiatan;
}
function namaSubkegiatan($kode)
{
    return RekeningBelanja::where('kode_subkegiatan', $kode)->first() == null ? null : RekeningBelanja::where('kode_subkegiatan', $kode)->first()->nama_subkegiatan;
}
function batasWaktu()
{
    $tanggal = Setting::first()->waktu;
    return Carbon::parse($tanggal)->format('M d, Y');
}
function targetDate()
{
    $data = BatasInput::where('is_aktif', 1)->first();
    return $data->sampai;
}

function satuan()
{
    return Satuan::get();
}
function runningText()
{
    return Setting::first()->running_text;
}
function statusRFK()
{
    if (Auth::user()->hasRole('admin')) {
        if (Auth::user()->skpd->murni == 1) {
            $result = 'murni';
        } elseif (Auth::user()->skpd->pergeseran == 1) {
            $result = 'pergeseran';
        } elseif (Auth::user()->skpd->perubahan == 1) {
            $result = 'perubahan';
        } else {
            $result = null;
        }
    } elseif (Auth::user()->hasRole('pptk')) {
        if (Auth::user()->pptk->skpd->murni == 1) {
            $result = 'murni';
        } elseif (Auth::user()->pptk->skpd->pergeseran == 1) {
            $result = 'pergeseran';
        } elseif (Auth::user()->pptk->skpd->perubahan == 1) {
            $result = 'perubahan';
        } else {
            $result = null;
        }
    } else {
        if (Auth::user()->bidang->skpd->murni == 1) {
            $result = 'murni';
        } elseif (Auth::user()->bidang->skpd->pergeseran == 1) {
            $result = 'pergeseran';
        } elseif (Auth::user()->bidang->skpd->perubahan == 1) {
            $result = 'perubahan';
        } else {
            $result = null;
        }
    }

    return $result;
}

function jenisRFK($bulan, $tahun)
{

    $result = JenisRfk::where('tahun', $tahun)->where('skpd_id', Auth::user()->skpd->id)->first()[$bulan];
    return $result;
}

function namaBulan($bulan)
{
    if ($bulan == '01') {
        $nama_bulan = 'Januari';
    }
    if ($bulan == '02') {
        $nama_bulan = 'Februari';
    }
    if ($bulan == '03') {
        $nama_bulan = 'Maret';
    }
    if ($bulan == '04') {
        $nama_bulan = 'April';
    }
    if ($bulan == '05') {
        $nama_bulan = 'Mei';
    }
    if ($bulan == '06') {
        $nama_bulan = 'Juni';
    }
    if ($bulan == '07') {
        $nama_bulan = 'Juli';
    }
    if ($bulan == '08') {
        $nama_bulan = 'Agustus';
    }
    if ($bulan == '09') {
        $nama_bulan = 'September';
    }
    if ($bulan == '10') {
        $nama_bulan = 'Oktober';
    }
    if ($bulan == '11') {
        $nama_bulan = 'November';
    }
    if ($bulan == '12') {
        $nama_bulan = 'Desember';
    }
    return $nama_bulan;
}


function namaRekening($kode)
{
    return RekeningBelanja::where('kode_rekening', $kode)->first()->nama_rekening;
}
function namaKomponen($kode)
{
    return SSH::where('kode', $kode)->first();
}
