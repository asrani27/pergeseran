@extends('layouts.app')
@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="/assets/bower_components/select2/dist/css/select2.min.css">

@endpush
@section('content')
<section class="content">
  <div class="row text-center">
    <h1><strong>BUAT PENGAJUAN BARU</strong></h1>
    <h3>SILAHKAN ISI FORM DI BAWAH INI UNTUK MEMBUAT PENGAJUAN BARU</h3>
  </div>


  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box">
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="/admin/pengajuan/create">
          @csrf
          <div class="box-body">
            <div class="col-xs-6">
              <div class="form-group">
                <label>No Surat</label>
                <input type="text" class="form-control" placeholder="no surat" name="nomor_surat">
              </div>
            </div>
            <div class="col-xs-6">
              <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" name="tanggal"
                  value="{{\Carbon\Carbon::today()->format('Y-m-d')}}">
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
                <select class="form-control select2" style="width: 100%;" required name="tipe_pengajuan">
                  <option selected="">Pilih Tipe Pengajuan Perubahan</option>
                  <option value="1">Antar Objek</option>
                  <option value="2">Antar Rincian Objek</option>
                  <option value="3">Antar Sub Rincian Objek</option>
                  <option value="4">Perubahan Uraian</option>
                </select>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label>Hal</label>
                <input type="text" class="form-control" placeholder="hal" name="hal">
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label>Kalimat pengantar</label>
                <textarea rows="4" class="form-control" name="pengantar"></textarea>
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
                <select id="program" class="form-control select2" style="width: 100%;" required name="program">
                  <option value="" selected>Pilih Program</option>
                  @foreach ($program as $item)
                  <option value="{{$item->id}}">{{$item->kode}} - {{$item->nama}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label>Kegiatan</label>
                <select id="kegiatan" class="form-control select2" style="width: 100%;" required name="kegiatan">
                  <option value="" selected>Pilih Kegiatan</option>
                  {{-- @foreach ($kegiatan as $item)
                  <option value="{{$item->id}}">{{$item->kode}} - {{$item->nama}}</option>
                  @endforeach --}}
                </select>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label>Sub Kegiatan</label>
                <select id="subkegiatan" class="form-control select2" style="width: 100%;" required name="subkegiatan">
                  <option value="" selected>Pilih SubKegiatan</option>
                  {{-- @foreach ($subkegiatan as $item)
                  <option value="{{$item->id}}">{{$item->kode}} - {{$item->nama}}</option>
                  @endforeach --}}
                </select>
              </div>
            </div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer text-center">
            <button type="submit" class="btn btn-primary btn-block"> <i class="fa fa-send"></i> Selanjutnya</button>
          </div>
        </form>
      </div>

    </div>
</section>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Sebelum </h4>
      </div>
      <div class="modal-body">
        <div class="col-xs-9">
          <div class="form-group">
            <label>Rekening Awal</label>
            <select id="rekeningawal" class="form-control select2" style="width: 100%;" required name="sebelum_a">
              <option value="" selected>Rekening Awal</option>
              @foreach ($rekening as $item)
              <option value="{{$item->id}}">{{$item->kode}} - {{$item->nama}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-xs-3">
          <div class="form-group">
            <label>Jumlah</label>
            <input type="text" class="form-control" placeholder="jumlah" required name="sebelum_b">
          </div>
        </div>

        <div class="col-xs-12">
          <div class="form-group">
            <label>Standar Satuan Harga</label>
            <select class="form-control select2" style="width: 100%;" required name="sebelum_d">
              <option selected="">Pilih Standar Satuan Harga</option>
              @foreach ($ssh as $item)
              <option value="{{$item->id}}">{{$item->kode}} - {{$item->uraian}} - {{$item->spesifikasi}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
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


  $("#program").change(function(){
  var id_program = $("#program").val(); 
  console.log(id_program);
  axios({
    method: 'get',
    url: '/kegiatan/'+id_program,
  })
  .then(function (response) {
    console.log(response.data.length);
    $("#kegiatan").html('');
    $("#subkegiatan").html('');
    $("#kegiatan").append('<option value="">-pilih kegiatan-</option>');
    for (var i = 0; i < response.data.length; i++) 
    {
      $("#kegiatan").append('<option value="' + response.data[i].id + '">' + response.data[i].kode +' '+ response.data[i].nama +  '</option>');
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
      $("#subkegiatan").append('<option value="' + response.data[i].id + '">' + response.data[i].kode +' '+ response.data[i].nama +  '</option>');
    }
    });
  })

})
</script>
@endpush