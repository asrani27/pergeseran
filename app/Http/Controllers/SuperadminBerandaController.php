<?php

namespace App\Http\Controllers;

use App\Models\SSH;
use App\Models\Timer;
use GuzzleHttp\Client;
use App\Models\Kegiatan;
use App\Models\Setting;
use App\Models\Subkegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SuperadminBerandaController extends Controller
{
    public function index()
    {
        $timer = Setting::first();
        $running_text = Setting::first()->running_text;
        return view('superadmin.home', compact('timer', 'running_text'));
    }

    public function updateTimer(Request $req)
    {
        Setting::first()->update([
            'waktu' => $req->waktu,
        ]);
        Session::flash('success', 'Berhasil diupdate');
        return back();
    }
    public function updateRunningText(Request $req)
    {
        Setting::first()->update([
            'running_text' => $req->running_text,
        ]);
        Session::flash('success', 'Berhasil diupdate');
        return back();
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
                $s->uraian = $item->nama_barang;
                $s->harga = $item->harga;
                $s->satuan = $item->satuan;
                $s->save();
            }
        }
        Session::flash('success', 'Berhasil Ditarik');
        return redirect('superadmin/beranda');
    }

    public function kegiatanJson($id)
    {
        $data = Kegiatan::where('program_id', $id)->get();
        return response()->json($data);
    }
    public function subkegiatanJson($id)
    {
        $data = Subkegiatan::where('kegiatan_id', $id)->get();
        return response()->json($data);
    }
}
