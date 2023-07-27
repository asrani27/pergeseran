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
        $n->status_operator = 2;
        $n->status_kepala_skpd = 1;
        $n->save();

        //save detail perubahan rekening
        $p = new PerubahanRekening;
        $p->pengajuan_id = $n->id;
        $p->sebelum_a = $req->sebelum_a;
        $p->sebelum_b = $req->sebelum_b;
        $p->sebelum_c = $req->sebelum_c;
        $p->sebelum_d = $req->sebelum_d;
        $p->sebelum_e = $req->sebelum_e;
        $p->sebelum_f = $req->sebelum_f;
        $p->setelah_a = $req->setelah_a;
        $p->setelah_b = $req->setelah_b;
        $p->setelah_c = $req->setelah_c;
        $p->setelah_d = $req->setelah_d;
        $p->setelah_e = $req->setelah_e;
        $p->setelah_f = $req->setelah_f;
        $p->save();

        Session::flash('success', 'Berhasil Di ajukan');
        return redirect('/admin/beranda');
    }
}
