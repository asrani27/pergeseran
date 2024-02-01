<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

class AdminBerandaController extends Controller
{
    public function deleteRekawal($id)
    {
        Sebelum::find($id)->delete();
        Session::flash('success', 'Berhasil dihapus');
        return back();
    }
    public function index()
    {
        $data = Pengajuan::where('skpd_id', Auth::user()->skpd->id)->orderBy('id', 'DESC')->paginate(15);
        return view('admin.home', compact('data'));
    }

    public function update($id)
    {

        $sebelum = Sebelum::where('pengajuan_id', $id)->get()->map(function ($item) {
            $item->total = $item->jumlah * $item->nominalssh;
            return $item;
        })->sum('total');

        $sesudah = Sesudah::where('pengajuan_id', $id)->get()->map(function ($item) {
            $item->total = $item->jumlah * $item->nominalssh;
            return $item;
        })->sum('total');
        if ($sebelum != $sesudah) {
            Session::flash('warning', 'Total sebelum tidak sama dengan total sesudah');
            return back();
        } else {
            Session::flash('success', 'Berhasil Di update');
            return back();
        }
    }
    public function storeSebelum(Request $req, $id)
    {
        $rek = Rekening::find($req->rekawal);

        $ssh = SSH::find($req->ssh);
        $s = new Sebelum;
        $s->pengajuan_id = $id;
        $s->rekawal = $rek->kode . ' ' . $rek->nama;
        $s->jumlah = $req->jumlah;
        $s->nominal = 'nominal';
        $s->ssh = $ssh->uraian;
        $s->satuan = $ssh->satuan;
        $s->nominalssh = $ssh->harga;
        $s->save();
        Session::flash('success', 'Berhasil disimpan');
        return back();
    }

    public function storeSesudah(Request $req, $id)
    {
        $rek = Rekening::find($req->rekawal);

        $ssh = SSH::find($req->ssh);
        $s = new Sesudah;
        $s->pengajuan_id = $id;
        $s->rekawal = $rek->kode . ' ' . $rek->nama;
        $s->jumlah = $req->jumlah;
        $s->nominal = 'nominal';
        $s->ssh = $ssh->uraian;
        $s->satuan = $ssh->satuan;
        $s->nominalssh = $ssh->harga;
        $s->save();
        Session::flash('success', 'Berhasil disimpan');
        return back();
    }

    public function detail($id)
    {
        $data = Pengajuan::find($id);

        $program = Program::where('skpd_id', Auth::user()->skpd->id)->get();
        $kegiatan = Kegiatan::where('skpd_id', Auth::user()->skpd->id)->get();
        $subkegiatan = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->get();
        $rekening = Rekening::where('skpd_id', Auth::user()->skpd->id)->where('subkegiatan_id', $id)->get();
        $ssh = SSH::get();

        $sebelum = Sebelum::where('pengajuan_id', $id)->get()->map(function ($item) {
            $item->total = $item->jumlah * $item->nominalssh;
            return $item;
        });

        $sesudah = Sesudah::where('pengajuan_id', $id)->get()->map(function ($item) {
            $item->total = $item->jumlah * $item->nominalssh;
            return $item;
        });
        return view('admin.detail', compact('data', 'program', 'kegiatan', 'subkegiatan', 'rekening', 'ssh', 'sebelum', 'sesudah'));
    }

    //     public function duplikatData()
    //     {
    //         //Membuka pergeseran, duplikat data mulai dari program, kegiatan, subkegiatan dan uraian berdasarkan tahun

    //         $logLatest = LogBukaTutup::where('skpd_id', Auth::user()->skpd->id)->latest()->first();
    //         if ($logLatest->ke == null) {
    //             $ke = 1;
    //         } else {
    //             $ke = $logLatest->ke + 1;
    //         }

    //         $tahun = Carbon::now()->format('Y');
    //         //menduplikat program
    //         $program = Program::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->where('jenis_rfk', 'murni')->get();

    //         foreach ($program as $key => $item) {
    //             $param = $item->toArray();
    //             $param['ke'] = $ke;
    //             $param['jenis_rfk'] = 'pergeseran';
    //             $param['before_id'] = $item->id;

    //             Program::create($param);
    //         }

    //         $kegiatan = Kegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->where('jenis_rfk', 'murni')->get();
    //         foreach ($kegiatan as $key => $item) {
    //             //dd($item, Program::where('before_id', $item->id)->get());
    //             $param = $item->toArray();
    //             $param['ke'] = $ke;
    //             $param['jenis_rfk'] = 'pergeseran';
    //             $param['before_id'] = $item->id;
    //             $param['program_id'] = Program::where('before_id', $item->program_id)->first()->id;

    //             Kegiatan::create($param);
    //         }

    //         $subkegiatan = Subkegiatan::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->where('jenis_rfk', 'murni')->get();
    //         foreach ($subkegiatan as $key => $item) {

    //             $param = $item->toArray();
    //             $param['ke'] = $ke;
    //             $param['jenis_rfk'] = 'pergeseran';
    //             $param['before_id'] = $item->id;
    //             $param['program_id'] = Program::where('before_id', $item->program_id)->first()->id;
    //             $param['kegiatan_id'] = Kegiatan::where('before_id', $item->kegiatan_id)->first()->id;

    //             Subkegiatan::create($param);
    //         }
    //         $uraian = Uraian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->where('jenis_rfk', 'murni')->get();

    //         foreach ($uraian as $key => $item) {

    //             $param = $item->toArray();
    //             $param['ke'] = $ke;
    //             $param['jenis_rfk'] = 'pergeseran';
    //             $param['before_id'] = $item->id;
    //             $param['program_id'] = Program::where('before_id', $item->program_id)->first()->id;
    //             $param['kegiatan_id'] = Kegiatan::where('before_id', $item->kegiatan_id)->first()->id;
    //             $param['subkegiatan_id'] = Subkegiatan::where('before_id', $item->subkegiatan_id)->first()->id;

    //             Uraian::create($param);
    //         }

    //         // if ($logLatest->ke == null) {
    //         //     $tahun = Carbon::now()->year;
    //         //     $data = Uraian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->get()->toArray();
    //         //     foreach ($data as $i) {
    //         //         $attr = $i;
    //         //         $attr['uraian_id'] = $i['id'];
    //         //         $attr['ke'] = $attr['status'] == null ? 1 : $attr['ke'] + 1;
    //         //         Uraian::create($attr);
    //         //     }

    //         //     return $data;
    //         // } else {
    //         //     $tahun = Carbon::now()->year;
    //         //     $data = Uraian::where('skpd_id', Auth::user()->skpd->id)->where('tahun', $tahun)->where('ke', $logLatest->ke)->get()->toArray();

    //         //     foreach ($data as $i) {
    //         //         $attr = $i;
    //         //         $attr['uraian_id'] = $i['uraian_id'];
    //         //         $attr['ke'] = $attr['ke'] == null ? 1 : $attr['ke'] + 1;
    //         //         Uraian::create($attr);
    //         //     }

    //         //     return $data;
    //         // }
    //     }


    //     public function bukaMurni()
    //     {

    //         if (LogBukaTutup::where('tahun', Carbon::now()->year)->where('nama', 'murni')->first() != null) {
    //             Session::flash('info', 'Murni hanya di buka sekali dalam setahun');
    //             return back();
    //         }
    //         if (Auth::user()->skpd->pergeseran != 0) {
    //             Session::flash('info', 'pergeseran harap di tutup terlebih dahulu');
    //             return back();
    //         }
    //         if (Auth::user()->skpd->perubahan != 0) {
    //             Session::flash('info', 'perubahan harap di tutup terlebih dahulu');
    //             return back();
    //         }

    //         Auth::user()->skpd->update(['murni' => 1]);

    //         $n = new LogBukaTutup;
    //         $n->tahun = Carbon::now()->year;
    //         $n->nama = 'murni';
    //         $n->jenis = 'buka';
    //         $n->skpd_id = Auth::user()->skpd->id;
    //         $n->save();

    //         Session::flash('success', 'Penginputan Dibuka');
    //         return back();
    //     }
    //     public function tutupMurni()
    //     {

    //         Auth::user()->skpd->update(['murni' => 0]);

    //         $n = new LogBukaTutup;
    //         $n->tahun = Carbon::now()->year;
    //         $n->nama = 'murni';
    //         $n->jenis = 'tutup';
    //         $n->skpd_id = Auth::user()->skpd->id;
    //         $n->save();
    //         Session::flash('success', 'Penginputan ditutup');
    //         return back();
    //     }

    //     public function bukaPergeseran()
    //     {
    //         $this->duplikatData();
    //         //check
    //         if (Auth::user()->skpd->murni != 0) {
    //             Session::flash('info', 'Murni Harap Di tutup terlebih dahulu');
    //             return back();
    //         }
    //         if (Auth::user()->skpd->perubahan != 0) {
    //             Session::flash('info', 'perubahan Harap Di tutup terlebih dahulu');
    //             return back();
    //         }

    //         //check ke berapa
    //         $cp = LogBukaTutup::where('tahun', Carbon::now()->year)->where('nama', 'pergeseran')->latest()->first();
    //         if ($cp == null) {
    //             //pergeseran pertama
    //             $n = new LogBukaTutup;
    //             $n->tahun = Carbon::now()->year;
    //             $n->nama = 'pergeseran';
    //             $n->ke = 1;
    //             $n->jenis = 'buka';
    //             $n->skpd_id = Auth::user()->skpd->id;
    //             $n->save();
    //         } else {
    //             //pergeseran selanjutnya
    //             $n = new LogBukaTutup;
    //             $n->tahun = Carbon::now()->year;
    //             $n->nama = 'pergeseran';
    //             $n->ke = $cp->ke + 1;
    //             $n->jenis = 'buka';
    //             $n->skpd_id = Auth::user()->skpd->id;
    //             $n->save();
    //         }

    //         Auth::user()->skpd->update(['pergeseran' => 1]);
    //         Session::flash('success', 'Penginputan Pergeseran Dibuka');

    //         return back();
    //     }
    //     public function tutupPergeseran()
    //     {
    //         $cp = LogBukaTutup::where('tahun', Carbon::now()->year)->where('nama', 'pergeseran')->latest()->first();
    //         Auth::user()->skpd->update(['pergeseran' => 0]);
    //         $n = new LogBukaTutup;
    //         $n->tahun = Carbon::now()->year;
    //         $n->nama = 'pergeseran';
    //         $n->ke = $cp->ke;
    //         $n->jenis = 'tutup';
    //         $n->skpd_id = Auth::user()->skpd->id;
    //         $n->save();
    //         Session::flash('success', 'Penginputan Pergeseran Ditutup');
    //         return back();
    //     }

    //     public function bukaPerubahan()
    //     {
    //         //check
    //         if (Auth::user()->skpd->murni != 0) {
    //             Session::flash('info', 'Murni Harap Di tutup terlebih dahulu');
    //             return back();
    //         }
    //         if (Auth::user()->skpd->pergeseran != 0) {
    //             Session::flash('info', 'perubahan Harap Di tutup terlebih dahulu');
    //             return back();
    //         }

    //         $tahun = Carbon::now()->year;
    //         //get murni duplikasi data
    //         $duplikatData = Uraian::where('tahun', $tahun)->where('skpd_id', Auth::user()->skpd->id)->where('status', null)->get();
    //         //dd($duplikatData);
    //         foreach ($duplikatData as $d) {
    //             $attr = $d->toArray();
    //             $attr['status'] = 99;
    //             $attr['uraian_id'] = $d->id;


    //             Uraian::create($attr);
    //         }

    //         Auth::user()->skpd->update(['perubahan' => 1]);
    //         Session::flash('success', 'Penginputan Perubahan Dibuka');
    //         return back();
    //     }
    //     public function tutupPerubahan()
    //     {
    //         Auth::user()->skpd->update(['perubahan' => 0]);
    //         Session::flash('success', 'Penginputan Ditutup');
    //         return back();
    //     }

    //     public function bukaRealisasi()
    //     {
    //         Auth::user()->skpd->update(['realisasi' => 1]);
    //         $n = new LogBukaTutup;
    //         $n->tahun = Carbon::now()->year;
    //         $n->nama = 'realisasi';
    //         $n->jenis = 'buka';
    //         $n->skpd_id = Auth::user()->skpd->id;
    //         $n->save();
    //         Session::flash('success', 'Penginputan Dibuka');
    //         return back();
    //     }
    //     public function tutupRealisasi()
    //     {
    //         Auth::user()->skpd->update(['realisasi' => 0]);
    //         $n = new LogBukaTutup;
    //         $n->tahun = Carbon::now()->year;
    //         $n->nama = 'realisasi';
    //         $n->jenis = 'tutup';
    //         $n->skpd_id = Auth::user()->skpd->id;
    //         $n->save();
    //         Session::flash('success', 'Penginputan Ditutup');
    //         return back();
    //     }
}
