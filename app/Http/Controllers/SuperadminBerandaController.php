<?php

namespace App\Http\Controllers;

use App\Models\SSH;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SuperadminBerandaController extends Controller
{
    public function index()
    {
        return view('superadmin.home');
    }

    public function tarikSSH()
    {
        $api_url    = 'https://standar-harga.banjarmasinkota.go.id/api/get-ssh';
        $client     = new Client();
        $response = $client->request("GET", $api_url);
        $data = json_decode($response->getBody()->getContents())->data;

        foreach ($data as $key => $item) {
            $check = SSH::where('kode', $item->kode_barang)->first();
            if ($check == null) {
                $s = new SSH;
                $s->kode = $item->kode_barang;
                $s->harga = $item->harga;
                $s->satuan = $item->satuan;
                $s->save();
            }
        }
        Session::flash('success', 'Berhasil Ditarik');
        return redirect('superadmin/beranda');
    }
}
