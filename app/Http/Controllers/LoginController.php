<?php

namespace App\Http\Controllers;

use captcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        // Session::flash('success', 'Ini notifikasi success');
        // Session::flash('warning', 'Ini notifikasi warning');
        // Session::flash('info', 'Ini notifikasi info');
        // Session::flash('error', 'Ini notifikasi error');

        if (Auth::check()) {
            if (Auth::user()->hasRole('superadmin')) {
                return redirect('/superadmin/beranda');
            } elseif (Auth::user()->hasRole('admin')) {
                return redirect('/admin/beranda');
            } elseif (Auth::user()->hasRole('kadis')) {
                return redirect('/pimpinan/beranda');
            } elseif (Auth::user()->hasRole('bpkpad')) {
                return redirect('/bpkpad/beranda');
            } else {
                return 'role lain';
            }
        }
        return view('login');
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha' => captcha_img()]);
    }

    public function login(Request $req)
    {
        $remember = $req->remember ? true : false;
        $credential = $req->only('username', 'password');

        if (Auth::attempt($credential, $remember)) {

            if (Auth::user()->hasRole('superadmin')) {
                Session::flash('success', 'Selamat Datang');
                return redirect('/superadmin/beranda');
            } elseif (Auth::user()->hasRole('admin')) {
                Session::flash('success', 'Selamat Datang');
                return redirect('/admin/beranda');
            } elseif (Auth::user()->hasRole('kadis')) {
                Session::flash('success', 'Selamat Datang');
                return redirect('/pimpinan/beranda');
            } elseif (Auth::user()->hasRole('bpkpad')) {
                Session::flash('success', 'Selamat Datang');
                return redirect('/bpkpad/beranda');
            } else {
                Session::flash('success', 'Selamat Datang');
                return 'role lain';
            }
        } else {
            Session::flash('error', 'username/password salah');
            $req->flash();
            return back();
        }
    }
}
