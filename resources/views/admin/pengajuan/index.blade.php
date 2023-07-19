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
                <input type="email" class="form-control" placeholder="no surat">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" value="{{\Carbon\Carbon::today()->format('Y-m-d')}}">
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                <label>Dari</label>
                <input type="text" class="form-control" placeholder="skpd" readonly>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                <label>Tipe Pengajuan Perubahan</label>
                  <select class="form-control select2" style="width: 100%;" required>
                    <option selected="">Pilih Tipe Pengajuan Perubahan</option>
                    <option value="1">Antar Objek</option>
                  </select>
                </div>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      
  </div>
</section>


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
@endpush
