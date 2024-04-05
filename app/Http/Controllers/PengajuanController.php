<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Rekening;
use App\Models\Pengajuan;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use App\Models\PerubahanRekening;
use App\Models\SSH;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PengajuanController extends Controller
{
    public function index()
    {
        $program = Program::where('skpd_id', Auth::user()->skpd->id)->get();
        $kegiatan = Kegiatan::where('skpd_id', Auth::user()->skpd->id)->get();
        $subkegiatan = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->get();
        $rekening = Rekening::where('skpd_id', Auth::user()->skpd->id)->get();
        $ssh = SSH::get();
        return view('admin.pengajuan.index', compact('program', 'kegiatan', 'subkegiatan', 'rekening', 'ssh'));
    }
    public function search()
    {
        $search = request()->get('search');
        $data = Pengajuan::where('skpd_id', Auth::user()->skpd->id)->where('nomor_surat', 'LIKE', '%' . $search . '%')->orderBy('id', 'DESC')->paginate(15);
        request()->flash();

        return view('kadis.home', compact('data'));
    }
    public function store(Request $req)
    {
        $n = new Pengajuan;
        $n->nomor_surat = $req->nomor_surat;
        $n->skpd_id = Auth::user()->skpd->id;
        $n->user_id = Auth::user()->id;
        $n->tanggal = $req->tanggal;
        $n->tipe_pengajuan = $req->tipe_pengajuan;
        $n->hal = $req->hal;
        $n->pengantar = $req->pengantar;
        $n->lampiran = $req->lampiran;
        $n->program_id = $req->program;
        $n->kegiatan_id = $req->kegiatan;
        $n->subkegiatan_id = $req->subkegiatan;
        $n->status_operator = 1;
        $n->status_kepala_skpd = 0;
        $n->save();

        Session::flash('success', 'Berhasil Di simpan');
        return redirect('/admin/beranda/detail/' . $n->id);
    }
}
