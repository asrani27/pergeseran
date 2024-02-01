<?php

namespace App\Http\Controllers;

use App\Models\SSH;
use App\Models\Program;
use App\Models\Sebelum;
use App\Models\Sesudah;
use App\Models\Kegiatan;
use App\Models\Rekening;
use App\Models\Pengajuan;
use App\Models\Subkegiatan;
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
        $program = Program::where('skpd_id', Auth::user()->kepala->id)->get();
        $kegiatan = Kegiatan::where('skpd_id', Auth::user()->kepala->id)->get();
        $subkegiatan = Subkegiatan::where('skpd_id', Auth::user()->kepala->id)->get();
        $rekening = Rekening::where('skpd_id', Auth::user()->kepala->id)->get();
        $ssh = SSH::get();
        $sebelum = Sebelum::where('pengajuan_id', $id)->get()->map(function ($item) {
            $item->total = $item->jumlah * $item->nominalssh;
            return $item;
        });

        $sesudah = Sesudah::where('pengajuan_id', $id)->get()->map(function ($item) {
            $item->total = $item->jumlah * $item->nominalssh;
            return $item;
        });
        return view('kadis.pengajuan.index', compact('data', 'program', 'kegiatan', 'subkegiatan', 'rekening', 'ssh', 'sebelum', 'sesudah'));
    }

    public function detail($id)
    {
        $data = Pengajuan::find($id);
        $program = Program::where('skpd_id', Auth::user()->kepala->id)->get();
        $kegiatan = Kegiatan::where('skpd_id', Auth::user()->kepala->id)->get();
        $subkegiatan = Subkegiatan::where('skpd_id', Auth::user()->kepala->id)->get();
        $rekening = Rekening::where('skpd_id', Auth::user()->kepala->id)->get();
        $ssh = SSH::get();
        $sebelum = Sebelum::where('pengajuan_id', $id)->get()->map(function ($item) {
            $item->total = $item->jumlah * $item->nominalssh;
            return $item;
        });

        $sesudah = Sesudah::where('pengajuan_id', $id)->get()->map(function ($item) {
            $item->total = $item->jumlah * $item->nominalssh;
            return $item;
        });
        return view('kadis.pengajuan.detail', compact('data', 'program', 'kegiatan', 'subkegiatan', 'rekening', 'ssh', 'sebelum', 'sesudah'));
    }
    public function search()
    {
        $search = request()->get('search');
        $data = Pengajuan::where('skpd_id', Auth::user()->kepala->id)->where('nomor_surat', 'LIKE', '%' . $search . '%')->orderBy('id', 'DESC')->paginate(15);
        request()->flash();

        return view('kadis.home', compact('data'));
    }
    public function terima($id)
    {
        $data = Pengajuan::find($id)->update([
            'status_kepala_skpd' => 2,
            'status_bpkpad' => 1
        ]);

        Session::flash('success', 'Pengajuan Diterima');
        return redirect('/pimpinan/beranda');
    }
    public function tolak($id)
    {
        $data = Pengajuan::find($id)->update([
            'status_kepala_skpd' => 3,
        ]);
        Session::flash('warning', 'Pengajuan Ditolak');
        return redirect('/pimpinan/beranda');
    }
    public function simpanTerima(Request $req)
    {
        $sebelum = Pengajuan::find($req->terima_id)->sebelum->map(function ($item) {
            $item->total = $item->jumlah * $item->nominalssh;
            return $item;
        })->sum('total');
        $sesudah = Pengajuan::find($req->terima_id)->sesudah->map(function ($item) {
            $item->total = $item->jumlah * $item->nominalssh;
            return $item;
        })->sum('total');
        if ($sebelum != $sesudah) {

            Session::flash('warning', 'Total Sebelum harus sama dengan total sesudah');
            return back();
        } else {

            $data = Pengajuan::find($req->terima_id)->update([
                'status_kepala_skpd' => 2,
                'status_bpkpad' => 1,
                'ket_kepala_skpd' => $req->ket_kepala_skpd
            ]);

            Session::flash('success', 'Pengajuan Diterima');
            return redirect('/pimpinan/beranda');
        }
    }
    public function simpanTolak(Request $req)
    {
        $data = Pengajuan::find($req->tolak_id)->update([
            'status_kepala_skpd' => 3,
            'ket_kepala_skpd' => $req->ket_kepala_skpd

        ]);
        Session::flash('warning', 'Pengajuan Ditolak');
        return redirect('/pimpinan/beranda');
    }
}
