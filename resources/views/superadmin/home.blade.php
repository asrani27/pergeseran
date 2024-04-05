@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<div class="row text-center">
    <img src="/logo/pemko.png" width="80px">
<h3>Selamat Datang di <br/>Aplikasi Pergeseran BPKPAD </h3>
</div>
<div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>0</h3>

          <p>Total Pengajuan</p>
        </div>
        <div class="icon">
          <i class="fa fa-file"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>0</h3>

          <p>Pengajuan Disetujui</p>
        </div>
        <div class="icon">
          <i class="fa fa-file"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>0</h3>

          <p>Pengajuan Di Tolak</p>
        </div>
        <div class="icon">
          <i class="fa fa-file"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>0</h3>

          <p>Pengajuan Di Proses</p>
        </div>
        <div class="icon">
          <i class="fa fa-file"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">
  <div class="col-lg-3 col-xs-6">
    <a href="/superadmin/tarikssh" class="btn btn-primary btn-block">Tarik SSH <i class="fa fa-refresh"></i></a>
  </div>
  <div class="col-lg-3 col-xs-6 text-center">
    Batas Waktu<br/>
    <form method="post" action="/superadmin/updatetimer">
      @csrf
      <input type="date" class="form-control" name="waktu" value="{{$timer->waktu}}">
      <button type="submit" class="btn btn-block btn-primary">UPDATE</button>
    </form>
  
  </div>
  <div class="col-lg-3 col-xs-6 text-center">
    Running Text<br/>
    <form method="post" action="/superadmin/updaterunningtext">
      @csrf
      <textarea class="form-control" rows="5" name="running_text">{{$running_text}}</textarea>
      <button type="submit" class="btn btn-block btn-primary">UPDATE</button>
    </form>
  
  </div>
  <div class="col-lg-3 col-xs-6">
  </div>
</div>
@endsection
@push('js')

@endpush
