<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;

class BpkpadController extends Controller
{
    public function index()
    {
        $data = Pengajuan::orderBy('id', 'DESC')->paginate(15);
        return view('bpkpad.home', compact('data'));
    }
    public function pengajuan($id)
    {
        $data = Pengajuan::find($id);
        return view('bpkpad.pengajuan.index', compact('data'));
    }
}
