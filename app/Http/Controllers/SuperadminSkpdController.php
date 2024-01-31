<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Skpd;
use App\Models\User;
use App\Models\Program;
use App\Models\Kegiatan;
use App\Models\Rekening;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SuperadminSkpdController extends Controller
{
    public function index()
    {
        $data = Skpd::get();
        return view('superadmin.skpd.index', compact('data'));
    }

    public function upload()
    {
        return view('superadmin.skpd.upload');
    }

    public function storeUpload(Request $req)
    {
        $file = $req->file;
        $type = 'Xlsx';

        $reader = IOFactory::createReader($type);
        $spreadsheet = $reader->load($file);

        $worksheet = $spreadsheet->getActiveSheet();
        $data = $worksheet->toArray();

        foreach ($data as $key => $i) {
            if ($key == 0) {
            } else {
                $skpd_id = Skpd::where('kode_skpd', $i[0])->first()->id;
                //check & simpan program
                $checkProgram = Program::where('skpd_id', $skpd_id)->where('kode', $i[3])->first();
                if ($checkProgram == null) {
                    $s = new Program;
                    $s->skpd_id = $skpd_id;
                    $s->kode = $i[3];
                    $s->nama = $i[4];
                    $s->save();
                } else {
                }

                //check & simpan kegiatan
                $checkKegiatan = Kegiatan::where('skpd_id', $skpd_id)->where('kode', $i[5])->first();
                if ($checkKegiatan == null) {
                    $s = new Kegiatan;
                    $s->program_id = Program::where('skpd_id', $skpd_id)->where('kode', $i[3])->first()->id;
                    $s->skpd_id = $skpd_id;
                    $s->kode = $i[5];
                    $s->nama = $i[6];
                    $s->save();
                } else {
                }


                //check & simpan subkegiatan
                $checkSubKegiatan = Subkegiatan::where('skpd_id', $skpd_id)->where('kode', $i[7])->first();
                if ($checkSubKegiatan == null) {
                    $s = new Subkegiatan;
                    $s->program_id = Program::where('skpd_id', $skpd_id)->where('kode', $i[3])->first()->id;
                    $s->kegiatan_id = Kegiatan::where('skpd_id', $skpd_id)->where('kode', $i[5])->first()->id;
                    $s->skpd_id = $skpd_id;
                    $s->kode = $i[7];
                    $s->nama = $i[8];
                    $s->save();
                } else {
                }


                //check & simpan rekening belanja
                $checkRekBelanja = Rekening::where('skpd_id', $skpd_id)->where('kode', $i[7])->first();
                if ($checkRekBelanja == null) {
                    $s = new Rekening;
                    $s->program_id = Program::where('skpd_id', $skpd_id)->where('kode', $i[3])->first()->id;
                    $s->kegiatan_id = Kegiatan::where('skpd_id', $skpd_id)->where('kode', $i[5])->first()->id;
                    $s->subkegiatan_id = Subkegiatan::where('skpd_id', $skpd_id)->where('kode', $i[7])->first()->id;
                    $s->skpd_id = $skpd_id;
                    $s->kode = $i[9];
                    $s->nama = $i[10];
                    $s->pagu = (int) str_replace(',', '', $i[11]);
                    $s->save();
                } else {
                }
            }
        }

        Session::flash('success', 'berhasil di import');
        return back();
    }
    public function createakun($id)
    {
        $role = Role::where('name', 'admin')->first();
        $skpd = Skpd::find($id);

        $n = new User;
        $n->name = $skpd->nama;
        $n->username = $skpd->kode_skpd;
        $n->password = bcrypt('adminskpd');
        $n->save();

        $skpd->update([
            'user_id' => $n->id,
        ]);

        $n->roles()->attach($role);

        Session::flash('success', 'Berhasil Dibuat, Password : adminskpd');
        return back();
    }

    public function resetakun($id)
    {
        Skpd::find($id)->user->update(['password' => bcrypt('adminskpd')]);
        Session::flash('success', 'Password : adminskpd');
        return back();
    }
    public function createakunkepala($id)
    {
        $role = Role::where('name', 'kadis')->first();
        $skpd = Skpd::find($id);

        $n = new User;
        $n->name = 'Pimpinan ' . $skpd->nama;
        $n->username = 'pimpinan_' . $skpd->kode_skpd;
        $n->password = bcrypt('pimpinan');
        $n->save();

        $skpd->update([
            'kepala_id' => $n->id,
        ]);

        $n->roles()->attach($role);

        Session::flash('success', 'Berhasil Dibuat, Password : pimpinan');
        return back();
    }

    public function resetakunkepala($id)
    {
        Skpd::find($id)->user->update(['password' => bcrypt('pimpinan')]);
        Session::flash('success', 'Password : pimpinan');
        return back();
    }
}
