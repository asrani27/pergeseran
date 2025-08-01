@extends('layouts.app')
@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="/assets/bower_components/select2/dist/css/select2.min.css">

@endpush
@section('content')
<section class="content">
  <div class="row text-center">
    <h1><strong>DETAIL PENGAJUAN</strong></h1>
  </div>


  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box">
        <!-- /.box-header -->
        <!-- form start -->
        <div class="box-body">
          <div class="col-xs-6">
            <div class="form-group">
              <label>No Surat</label>
              <input type="text" class="form-control" placeholder="no surat" value="{{$data->nomor_surat}}" readonly>
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group">
              <label>Tanggal</label>
              <input type="date" class="form-control" name="tanggal" value="{{$data->tanggal}}">
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Dari</label>
              <input type="text" class="form-control" value="{{Auth::user()->skpd->nama}}" readonly>
              <input type="hidden" name="skpd_id" class="form-control" value="{{Auth::user()->skpd->id}}" readonly>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Tipe Pengajuan Perubahan</label>
              <select class="form-control select2" style="width: 100%;" disabled name="tipe_pengajuan">
                <option selected="">Pilih Tipe Pengajuan Perubahan</option>
                <option value="1" {{$data->tipe_pengajuan == '1' ? 'selected':''}}>Antar Objek</option>
                <option value="2" {{$data->tipe_pengajuan == '2' ? 'selected':''}}>Antar Rincian Objek</option>
                <option value="3" {{$data->tipe_pengajuan == '3' ? 'selected':''}}>Antar Sub Rincian Objek</option>
                <option value="4" {{$data->tipe_pengajuan == '4' ? 'selected':''}}>Perubahan Uraian</option>
              </select>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Hal</label>
              <input type="text" class="form-control" placeholder="hal" readonly value="{{$data->hal}}">
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Kalimat pengantar</label>
              <textarea rows="4" class="form-control" readonly>{{$data->pengantar}}</textarea>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Lampiran</label>
              <input type="file" class="form-control" name="lampiran">
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Program</label>
              <input type="text" class="form-control"
                value="{{$data->kode_program}} {{namaProgram($data->kode_program)}}" readonly>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Kegiatan</label>
              <input type="text" class="form-control"
                value="{{$data->kode_kegiatan}} {{namaKegiatan($data->kode_kegiatan)}}" readonly>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Sub Kegiatan</label>
              <input type="text" class="form-control"
                value="{{$data->kode_subkegiatan}} {{namaSubkegiatan($data->kode_subkegiatan)}}" readonly>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="box box-primary box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Perubahan Rekening</h3>

                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body" style="">
                <div class="col-xs-12">
                  <div class="box box-info box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Sebelum Dirubah</h3>
                      <!-- /.box-tools -->

                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">

                      @if ($data->status_operator != 2)
                      <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                        data-target="#modal-default">
                        Tambah
                      </button><br />
                      @endif
                      <table class="table table-condensed">
                        <tr style="background-color: aquamarine;">
                          <th style="border:1px solid black">No</th>
                          <th style="border:1px solid black">Rekening Awal</th>
                          <th style="border:1px solid black">Jenis SSH</th>
                          <th style="border:1px solid black">Spesifikasi Komponen</th>
                          <th style="border:1px solid black">Satuan</th>
                          <th style="border:1px solid black">Harga</th>
                          <th style="border:1px solid black">Koefisien</th>
                          <th style="border:1px solid black">Total</th>
                          <th style="border:1px solid black"></th>
                        </tr>
                        @foreach ($sebelum as $key => $item)
                        <tr>
                          <td style="border:1px solid black">{{$key+1}}</td>
                          <td style="border:1px solid black">{{$item->kode_rekening}}<br />
                            {{namaRekening($item->kode_rekening)}}
                          </td>
                          <td style="border:1px solid black">{{$item->jenis_ssh}}</td>
                          <td style="border:1px solid black">{{$item->kode_komponen}}<br />
                            {{namaKomponen($item->kode_komponen)->uraian}}
                            {{namaKomponen($item->kode_komponen)->spesifikasi}}
                          </td>
                          <td style="border:1px solid black">{{$item->satuan}}</td>
                          <td style="border:1px solid black; text-align:right;">{{number_format($item->harga)}}</td>
                          <td style="border:1px solid black">
                            Koefisien : <br />
                            {{$item->koefisien1}} {{$item->satuan1}} <br />
                            {{$item->koefisien2}} {{$item->satuan2}} <br />
                            {{$item->koefisien3}} {{$item->satuan3}} <br />
                          </td>
                          <td style="border:1px solid black; text-align:right;">{{number_format($item->total)}}</td>
                          <td style="border:1px solid black">
                            @if ($data->status_operator != 2)
                            <a href="/admin/beranda/hapussebelum/{{$item->id}}" class="btn btn-xs btn-danger"
                              onclick="return confirm(' Yakin ingin di hapus?');">
                              <i class="fa fa-times"></i> Hapus
                            </a>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                        <tr>
                          <td style="border:1px solid black; text-align:right; font-weight:bold" colspan=7>TOTAL</td>
                          <td style="border:1px solid black; text-align:right;">
                            {{number_format($sebelum->sum('total'))}}</td>
                        </tr>
                      </table>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer with-border">
                      {{-- Total : {{number_format($sebelum->sum('total'))}} --}}
                    </div>
                  </div>
                  <!-- /.box -->
                </div>
                <div class="col-xs-12">
                  <div class="box box-info box-solid">
                    <div class="box-header with-border">
                      <h3 class="box-title">Setelah Dirubah</h3>
                      <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="">

                      @if ($data->status_operator != 2)
                      <button type="button" class="btn btn-xs btn-primary" data-toggle="modal"
                        data-target="#modal-default2">
                        Tambah
                      </button><br />
                      @endif

                      <table class="table table-condensed">
                        <tr style="background-color: aquamarine;">
                          <th style="border:1px solid black">No</th>
                          <th style="border:1px solid black">Rekening Awal</th>
                          <th style="border:1px solid black">Jenis SSH</th>
                          <th style="border:1px solid black">Spesifikasi Komponen</th>
                          <th style="border:1px solid black">Satuan</th>
                          <th style="border:1px solid black">Harga</th>
                          <th style="border:1px solid black">Koefisien</th>
                          <th style="border:1px solid black">Total</th>
                          <th style="border:1px solid black"></th>
                        </tr>
                        @foreach ($sesudah as $key => $item)
                        <tr>
                          <td style="border:1px solid black">{{$key+1}}</td>
                          <td style="border:1px solid black">{{$item->kode_rekening}}<br />
                            {{namaRekening($item->kode_rekening)}}
                          </td>
                          <td style="border:1px solid black">{{$item->jenis_ssh}}</td>
                          <td style="border:1px solid black">{{$item->kode_komponen}}<br />
                            {{namaKomponen($item->kode_komponen)->uraian}}
                            {{namaKomponen($item->kode_komponen)->spesifikasi}}
                          </td>
                          <td style="border:1px solid black">{{$item->satuan}}</td>
                          <td style="border:1px solid black; text-align:right;">{{number_format($item->harga)}}</td>
                          <td style="border:1px solid black">
                            Koefisien : <br />
                            {{$item->koefisien1}} {{$item->satuan1}} <br />
                            {{$item->koefisien2}} {{$item->satuan2}} <br />
                            {{$item->koefisien3}} {{$item->satuan3}} <br />
                          </td>
                          <td style="border:1px solid black; text-align:right;">{{number_format($item->total)}}</td>
                          <td style="border:1px solid black">
                            @if ($data->status_operator != 2)
                            <a href="/admin/beranda/hapussesudah/{{$item->id}}" class="btn btn-xs btn-danger"
                              onclick="return confirm(' Yakin ingin di hapus?');">
                              <i class="fa fa-times"></i> Hapus
                            </a>
                            @endif
                          </td>
                        </tr>
                        @endforeach
                        <tr>
                          <td style="border:1px solid black; text-align:right; font-weight:bold" colspan=7>TOTAL</td>
                          <td style="border:1px solid black; text-align:right;">
                            {{number_format($sesudah->sum('total'))}}</td>
                        </tr>
                      </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer with-border">

                    </div>
                  </div>
                  <!-- /.box -->
                </div>

                @if ($data->status_operator == 2)
                <div class="col-xs-12 text-center">
                  <a href="#" class="btn btn-success">
                    <i class="fa fa-check"></i>
                    Pengajuan Telah Dikirim</a>
                </div>
                @else
                <div class="col-xs-12 text-center">
                  <a href="/admin/beranda/detail/{{$data->id}}/update" class="btn btn-primary"
                    onclick="return confirm('apakah sudah yakin ingin mengirim?');"> <i class="fa fa-send"></i>
                    Kirim</a>
                </div>
                @endif

              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>


        </div>
      </div>

    </div>
</section>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog " style="margin-top:2%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Sebelum </h4>
      </div>
      <div class="modal-body">
        <form method="post" action="/admin/beranda/detail/{{$data->id}}/sebelum">
          @csrf
          <div class="col-xs-12">
            <div class="form-group">
              <label>Rekening / Akun</label>
              <select id="rekeningawal" class="form-control select2" style="width: 100%;" required name="rekawal">
                <option value="" selected>-</option>
                @foreach ($rekening as $item)
                <option value="{{$item->kode_rekening}}">{{$item->kode_rekening}} - {{$item->nama_rekening}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Jenis Standar Harga</label>
              <select class="form-control select2" style="width: 100%;" required name="jenisssh">
                <option value="" selected>-</option>
                <option value="SSH">SSH</option>
                <option value="HSPK">HSPK</option>
                <option value="SBU">SBU</option>
                <option value="ASB">ASB</option>
              </select>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Spesifikasi Komponen</label>
              <select id="spesifikasi" class="form-control select2" style="width: 100%;" required name="komponenawal">
                <option value="" selected>-</option>
                @foreach ($ssh as $item)
                <option value="{{$item->kode}}">{{$item->kode}} - {{$item->uraian}} - {{$item->spesifikasi}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Satuan</label>
              <input type="text" class="form-control" placeholder="-" id="satuan_sebelum" name='satuan_sebelum'
                readonly>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Harga Satuan</label>
              <input type="text" class="form-control" placeholder="-" id="harga_sebelum" name="harga_sebelum" readonly>
            </div>
          </div>

          <div class="col-xs-6">
            <div class="form-group">
              <label>Koefisien</label>
              <input type="text" class="form-control" name="koefisien1" required>
              <input type="text" class="form-control" name="koefisien2">
              <input type="text" class="form-control" name="koefisien3">
            </div>
          </div>
          <div class="col-xs-6">
            <div class="form-group">
              <label>Satuan</label>
              <select class="form-control select2" style="width: 100%;" name="satuan1">
                <option value="" selected>-</option>
                @foreach (satuan() as $item)
                <option value="{{$item->nama}}">{{$item->nama}}</option>
                @endforeach
              </select>
              <select class="form-control select2" style="width: 100%;" name="satuan2">
                <option value="" selected>-</option>
                @foreach (satuan() as $item)
                <option value="{{$item->nama}}">{{$item->nama}}</option>
                @endforeach
              </select>
              <select class="form-control select2" style="width: 100%;" name="satuan3">
                <option value="" selected>-</option>
                @foreach (satuan() as $item)
                <option value="{{$item->nama}}">{{$item->nama}}</option>
                @endforeach
              </select>
            </div>
          </div>

          {{-- <div class="col-xs-12">
            <div class="form-group">
              <label>Total Belanja</label>
              <input type="text" class="form-control" placeholder="-" id="total_sebelum" name="total_sebelum" readonly>
            </div>
          </div> --}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-default2">
  <div class="modal-dialog " style="margin-top:2%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Menjadi </h4>
      </div>
      <div class="modal-body">
        <form method="post" action="/admin/beranda/detail/{{$data->id}}/sesudah">
          @csrf
          <div class="col-xs-12">
            <div class="form-group">
              <label>Rekening / Akun</label>
              <select id="rekeningakhir" class="form-control select2" style="width: 100%;" required name="rekakhir">
                <option value="" selected>-</option>
                @foreach ($rekening as $item)
                <option value="{{$item->kode_rekening}}">{{$item->kode_rekening}} - {{$item->nama_rekening}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Jenis Standar Harga</label>
              <select class="form-control select2" style="width: 100%;" required name="jenisssh">
                <option value="" selected>-</option>
                <option value="SSH">SSH</option>
                <option value="HSPK">HSPK</option>
                <option value="SBU">SBU</option>
                <option value="ASB">ASB</option>
              </select>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Komponen</label>
              <select id="spesifikasi_akhir" class="form-control select2" style="width: 100%;" required
                name="komponenakhir">
                <option value="" selected>-</option>
                @foreach ($ssh as $item)
                <option value="{{$item->kode}}">{{$item->kode}} - {{$item->uraian}} - {{$item->spesifikasi}}</option>
                @endforeach
              </select>
            </div>
          </div>
          {{-- <div class="col-xs-12">
            <div class="form-group">
              <label>Spesifikasi Komponen</label>
              <select id="spekkomponenawal" class="form-control select2" style="width: 100%;" required
                name="spekkomponenawal">
                <option selected="">-</option>
              </select>
            </div>
          </div> --}}
          <div class="col-xs-12">
            <div class="form-group">
              <label>Satuan</label>
              <input type="text" class="form-control" placeholder="-" id="satuan_sesudah" name='satuan_sesudah'
                readonly>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Harga Satuan</label>
              <input type="text" class="form-control" placeholder="-" id="harga_sesudah" name='harga_sesudah' readonly>
            </div>
          </div>

          <div class="col-xs-6">
            <div class="form-group">
              <label>Koefisien</label>
              <input type="text" class="form-control" name="koefisien1" required>
              <input type="text" class="form-control" name="koefisien2">
              <input type="text" class="form-control" name="koefisien3">
            </div>
          </div>

          <div class="col-xs-6">
            <div class="form-group">
              <label>Satuan</label>
              <select class="form-control select2" style="width: 100%;" name="satuan1">
                <option value="" selected>-</option>
                @foreach (satuan() as $item)
                <option value="{{$item->nama}}">{{$item->nama}}</option>
                @endforeach
              </select>
              <select class="form-control select2" style="width: 100%;" name="satuan2">
                <option value="" selected>-</option>
                @foreach (satuan() as $item)
                <option value="{{$item->nama}}">{{$item->nama}}</option>
                @endforeach
              </select>
              <select class="form-control select2" style="width: 100%;" name="satuan3">
                <option value="" selected>-</option>
                @foreach (satuan() as $item)
                <option value="{{$item->nama}}">{{$item->nama}}</option>
                @endforeach
              </select>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

@endsection
@push('js')

<!-- Select2 -->
<script src="/assets/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
  $(document).ready(function(){

$("#spesifikasi").change(function(){
  var id_spesifikasi = $("#spesifikasi").val(); 
  console.log(id_spesifikasi);
  axios({
    method: 'get',
    url: '/ssh/'+id_spesifikasi,
  })
  .then(function (response) {
    console.log(response.data);
    document.getElementById("satuan_sebelum").value =response.data.satuan;
    document.getElementById("harga_sebelum").value =response.data.harga.toLocaleString('en-US');
    });
  });

  $("#spesifikasi_akhir").change(function(){
  var id_spesifikasi = $("#spesifikasi_akhir").val(); 
  console.log(id_spesifikasi);
  axios({
    method: 'get',
    url: '/ssh/'+id_spesifikasi,
  })
  .then(function (response) {
    console.log(response.data);
    document.getElementById("satuan_sesudah").value =response.data.satuan;
    document.getElementById("harga_sesudah").value =response.data.harga.toLocaleString('en-US');
    });
  });

  $("#rekeningawal").change(function(){
  var kode_rekeningawal = $("#rekeningawal").val(); 
  
  axios({
    method: 'get',
    url: '/rekeningawal/'+kode_rekeningawal,
  })
  .then(function (response) {
    console.log(response.data.length);
    $("#sshawal").html('');
    $("#sshawal").append('<option value="">-pilih ssh-</option>');
    for (var i = 0; i < response.data.length; i++) 
    {
      $("#sshawal").append('<option value="' + response.data[i].kode_ssh + '">' + response.data[i].kode_ssh +' '+ response.data[i].nama_ssh +' '+ response.data[i].pagu.toLocaleString('id-ID')  +'  '+  '</option>');
    }
    });
  })

  $("#kegiatan").change(function(){
  var id_kegiatan = $("#kegiatan").val(); 
  console.log(id_kegiatan);
  axios({
    method: 'get',
    url: '/subkegiatan/'+id_kegiatan,
  })
  .then(function (response) {
    console.log(response.data.length);
    $("#subkegiatan").html('');
    $("#subkegiatan").append('<option value="">-pilih subkegiatan-</option>');
    for (var i = 0; i < response.data.length; i++) 
    {
      $("#subkegiatan").append('<option value="' + response.data[i].kode_subkegiatan + '">' + response.data[i].kode_subkegiatan +' '+ response.data[i].nama_subkegiatan +  '</option>');
    }
    });
  })

})
</script>
@endpush