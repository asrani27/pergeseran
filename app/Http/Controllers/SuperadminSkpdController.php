<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Skpd;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SuperadminSkpdController extends Controller
{
    public function index()
    {
        $data = Skpd::get();
        return view('superadmin.skpd.index', compact('data'));
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
        $n->name = $skpd->nama;
        $n->username = $skpd->kode_skpd;
        $n->password = bcrypt('pimpinan');
        $n->save();

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
