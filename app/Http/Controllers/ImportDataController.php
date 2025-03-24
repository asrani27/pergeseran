<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\SatuanImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class ImportDataController extends Controller
{

    public function index()
    {
        return view('superadmin.import');
    }

    public function satuan(Request $req)
    {
        Excel::import(new SatuanImport, $req->file);
        Session::flash('success', 'Satuan DiImport');
        return back();
    }

    public function subkegiatan(Request $req)
    {
        Excel::queueImport(new SubKegiatanImport, $req->file('file'));
        return back();
    }

    public function kegiatan(Request $req)
    {
        Excel::queueImport(new KegiatanImport, $req->file('file'));
        return back();
    }

    public function program(Request $req)
    {
        Excel::queueImport(new ProgramImport, $req->file('file'));
        return back();
    }
}
