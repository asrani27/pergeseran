<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class KadisController extends Controller
{
    public function index()
    {
        $data = Pengajuan::where('skpd_id', Auth::user()->kepala->id)->orderBy('id', 'DESC')->paginate(15);
        return view('kadis.home', compact('data'));
    }
    public function pengajuan($id)
    {
        $data = Pengajuan::find($id);
        return view('kadis.pengajuan.index', compact('data'));
    }

    public function terima($id)
    {
        $data = Pengajuan::find($id)->update([
            'status_kepala_skpd' => 1
        ]);

        Session::flash('success', 'Pengajuan Diterima');
        return redirect('/pimpinan/beranda');
    }
    public function tolak($id)
    {
        $data = Pengajuan::find($id)->update([
            'status_kepala_skpd' => 2
        ]);
        Session::flash('warning', 'Pengajuan Ditolak');
        return redirect('/pimpinan/beranda');
    }
}
