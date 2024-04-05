<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;
use App\Models\KunciRekening;
use Illuminate\Support\Facades\Session;

class KunciRekeningController extends Controller
{
    public function index()
    {
        $data = KunciRekening::get();
        return view('superadmin.kunci.index', compact('data'));
    }

    public function edit($id)
    {
        $rekening = Rekening::get();
        $data = KunciRekening::find($id);
        return view('superadmin.kunci.add', compact('rekening', 'data'));
    }
    public function update(Request $req, $id)
    {
    }
    public function store(Request $req)
    {
        $check = KunciRekening::where('kode', $req->kode)->first();
        if ($check == null) {
            $n = new KunciRekening();
            $n->kode = $req->kode;
            $n->nama = Rekening::where('kode', $req->kode)->first()->nama;
            $n->save();
            Session::flash('success', 'berhasil');
            return redirect('/superadmin/kunci_rekening');
        } else {

            Session::flash('info', 'sudah ada');
            return back();
        }
    }
    public function delete($id)
    {
        $data = KunciRekening::find($id)->delete();
        Session::flash('success', 'berhasil');
        return redirect('/superadmin/kunci_rekening');
    }
    public function add()
    {
        $rekening = Rekening::get();
        return view('superadmin.kunci.add', compact('rekening'));
    }
}
