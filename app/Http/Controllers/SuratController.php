<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SuratController extends Controller
{
    public function index()
    {
        $data = Surat::where('skpd_id', Auth::user()->skpd->id)->get();
        return view('admin.surat.index', compact('data'));
    }
    public function add()
    {
        return view('admin.surat.add');
    }
    public function store(Request $req)
    {
        $param = $req->all();
        $param['skpd_id'] = Auth::user()->skpd->id;
        Surat::create($param);
        Session::flash('success', 'berhasil');
        return redirect('/admin/surat');
    }
    public function edit($id)
    {
        $data = Surat::find($id);
        return view('admin.surat.edit', compact('data'));
    }
    public function update(Request $req, $id) {}
    public function delete($id)
    {
        $data = Surat::find($id)->delete();
        Session::flash('success', 'berhasil');
        return back();
    }
    public function surat1($id)
    {
        $customPaper = array(0, 0, 610, 860);
        $data = Surat::find($id);
        $pdf = PDF::loadView('admin.surat.surat1', compact('data'))->setPaper($customPaper);
        return $pdf->stream(Auth::user()->skpd->nama . '_surat1.pdf');
    }
    public function surat2($id)
    {
        $customPaper = array(0, 0, 610, 860);
        $data = Surat::find($id);
        $pdf = PDF::loadView('admin.surat.surat2', compact('data'))->setPaper($customPaper);
        return $pdf->stream(Auth::user()->skpd->nama . '_surat2.pdf');
    }
    public function surat3($id)
    {
        $customPaper = array(0, 0, 610, 860);
        $data = Surat::find($id);
        $pdf = PDF::loadView('admin.surat.surat3', compact('data'))->setPaper($customPaper);
        return $pdf->stream(Auth::user()->skpd->nama . '_surat3.pdf');
    }
}
