<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function index()
    {
        $data = Satuan::paginate(20);
        return view('superadmin.satuan.index', compact('data'));
    }
    public function search()
    {
        $search = request()->get('search');
        $data = Satuan::where('nama', 'LIKE', '%' . $search . '%')->paginate(20);
        request()->flash();

        return view('superadmin.satuan.index', compact('data'));
    }
}
