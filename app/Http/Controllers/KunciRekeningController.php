<?php

namespace App\Http\Controllers;

use App\Models\KunciRekening;
use App\Models\Rekening;
use Illuminate\Http\Request;

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
    }
    public function delete($id)
    {
    }
    public function add()
    {
        $rekening = Rekening::get();
        return view('superadmin.kunci.add', compact('rekening'));
    }
}
