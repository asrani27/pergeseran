<?php

namespace App\Http\Controllers;

use App\Models\SSH;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Xls;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class SSHController extends Controller
{
    public function index()
    {
        $data = SSH::paginate(20);
        return view('superadmin.ssh.index', compact('data'));
    }
    public function search()
    {
        $search = request()->get('search');
        $data = SSH::where('kode', 'LIKE', '%' . $search . '%')->orWhere('uraian', 'LIKE', '%' . $search . '%')->orderBy('id', 'DESC')->paginate(20);
        request()->flash();

        return view('superadmin.ssh.index', compact('data'));
    }
    public function upload()
    {
        return view('superadmin.ssh.upload');
    }
    public function storeUpload(Request $req)
    {


        $extention = $req->file->getClientOriginalExtension();
        if ($extention == 'xlsx' || $extention == 'xls') {
            $rand = Str::random(15);
            $req->file->move(storage_path('file'), $rand . '.xlsx');

            $path = storage_path('file') . '/' . $rand . '.xlsx';
            $reader = new Xlsx();
            $spreadsheet = $reader->load($path);
            $sheet = $spreadsheet->getActiveSheet()->toArray();
            dd($sheet);
            foreach ($sheet as $key => $item) {
                if ($key != 0) {
                    $str_arr = explode(",", $item[8]);
                    foreach ($str_arr as $key2 => $item2) {
                        $check = SSH::where('kode', $item[0])->where('kode_rekening', str_replace(' ', '', $item2))->first();
                        if ($check == null) {
                            $n = new SSH;
                            $n->kode = $item[3];
                            $n->uraian = $item[4];
                            $n->spesifikasi = $item[5];
                            $n->satuan = $item[6];
                            $n->harga = $item[7];
                            $n->kode_rekening = str_replace(' ', '', $item2);
                            $n->jenis = $item[9];
                            $n->save();
                        }
                    }
                }
            }
            Session::flash('success', 'File berhasil di import');
            return back();
        } else {
            Session::flash('error', 'File Harus excel');
            return back();
        }
    }
}
