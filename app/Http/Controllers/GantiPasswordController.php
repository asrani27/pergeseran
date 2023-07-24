<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GantiPasswordController extends Controller
{
    public function admin()
    {
        return view('admin.gantipass');
    }
    public function index()
    {
        return view('gantipass');
    }
}
