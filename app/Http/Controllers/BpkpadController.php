<?php

namespace App\Http\Controllers;

use App\Models\SSH;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Rekening;
use App\Models\Pengajuan;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BpkpadController extends Controller
{
    public function index()
    {
        $data = Pengajuan::orderBy('id', 'DESC')->paginate(15);
        return view('bpkpad.home', compact('data'));
    }

    public function search()
    {
        $search = request()->get('search');
        $data = Pengajuan::where('nomor_surat', 'LIKE', '%' . $search . '%')->orderBy('id', 'DESC')->paginate(15);
        request()->flash();

        return view('bpkpad.home', compact('data'));
    }
    public function pengajuan($id)
    {
        $data = Pengajuan::find($id);
        $program = Program::get();
        $kegiatan = Kegiatan::get();
        $subkegiatan = Subkegiatan::get();
        $rekening = Rekening::get();
        $ssh = SSH::get();
        return view('bpkpad.pengajuan.index', compact('data', 'program', 'kegiatan', 'subkegiatan', 'rekening', 'ssh'));
    }
    public function detail($id)
    {
        $data = Pengajuan::find($id);
        $program = Program::get();
        $kegiatan = Kegiatan::get();
        $subkegiatan = Subkegiatan::get();
        $rekening = Rekening::get();
        $ssh = SSH::get();
        return view('bpkpad.pengajuan.detail', compact('data', 'program', 'kegiatan', 'subkegiatan', 'rekening', 'ssh'));
    }
    public function terima($id)
    {
        $data = Pengajuan::find($id)->update([
            'status_bpkpad' => 2
        ]);

        Session::flash('success', 'Pengajuan Diterima');
        return redirect('/bpkpad/beranda');
    }
    public function tolak($id)
    {
        $data = Pengajuan::find($id)->update([
            'status_bpkpad' => 3
        ]);
        Session::flash('warning', 'Pengajuan Ditolak');
        return redirect('/bpkpad/beranda');
    }
    public function simpanTerima(Request $req)
    {
        $data = Pengajuan::find($req->terima_id)->update([
            'status_bpkpad' => 2,
            'ket_bpkpad' => $req->ket_bpkpad
        ]);

        Session::flash('success', 'Pengajuan Diterima');
        return redirect('/bpkpad/beranda');
    }
    public function simpanTolak(Request $req)
    {
        $data = Pengajuan::find($req->tolak_id)->update([
            'status_kepala_skpd' => 3,
            'ket_bpkpad' => $req->ket_bpkpad

        ]);
        Session::flash('warning', 'Pengajuan Ditolak');
        return redirect('/bpkpad/beranda');
    }
}
