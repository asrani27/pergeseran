@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
  <div class="row text-center">
    <h1><strong>DAFTAR PENGAJUAN PERGESERAN ANGGARAN</strong></h1>
    <h3>FILTER SURAT</h3>
  </div>
  
  <div class="row">
    <div class="col-xs-12">
      <div class="box" style="border-top-color: #008080">
      
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-hover">
            <tbody>
              <form method="get" action="/bpkpad/beranda/filter">
                @csrf
                <div class="col-xs-12">
                  <div class="form-group">
                  <label>Masukkan No Surat</label>
                  <input type="text" class="form-control" name="search" value="{{old('search')}}" placeholder="no surat">
                  </div>
                </div>
              </form>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>


      <div class="box" style="border-top-color: #008080">
        <div class="box-body">
          <table class="table table-condensed">
            <tbody>
              <tr style="background-color: #008080; color:aliceblue">
                <th rowspan=2 style="width: 10px">No</th>
                <th rowspan=2  class="text-center">Tanggal</th>
                <th rowspan=2  class="text-center">Nomor Surat</th>
                <th rowspan=2  class="text-center">SKPD</th>
                <th colspan=3  class="text-center">Progress</th>
              </tr>
              <tr style="background-color: #008080; color:aliceblue">
                <th class="text-center">Operator</th>
                <th class="text-center">Kepala SKPD</th>
                <th class="text-center">BPKPAD</th>
              </tr>

              @php
                  $no = 1;
              @endphp
              @foreach ($data as $item)
              <tr>
                <td>{{$no++}}</td>
                <td>{{\Carbon\Carbon::parse($item->tanggal)->format('d-m-Y')}}</td>
                <td>
                  {{$item->nomor_surat}}
                </td>
                <td>
                  {{$item->skpd->nama}}
                </td>
                <td class="text-center">
                  @switch($item->status_operator)
                      @case(1)
                          
                      <a href="#" class="btn btn-xs btn-primary"><i class="fa fa-hourglass"></i></a>
                          @break
                      @case(2)
                          
                      <a href="#" class="btn btn-xs btn-success"><i class="fa fa-check"></i></a>
                          @break
                      @default
                          
                      <a href="#" class="btn btn-xs bg-gray"><i class="fa fa-hourglass"></i></a>
                  @endswitch
                </td>
                <td class="text-center">
                  @switch($item->status_kepala_skpd)
                      @case(1)
                          
                      <a href="#" class="btn btn-xs btn-primary"><i class="fa fa-hourglass"></i></a>
                          @break
                      @case(2)
                          
                      <a href="#" class="btn btn-xs btn-success"><i class="fa fa-check"></i></a>
                          @break
                      @default
                          
                      <a href="#" class="btn btn-xs bg-gray"><i class="fa fa-hourglass"></i></a>
                  @endswitch
                </td>
                <td class="text-center">

                  @switch($item->status_bpkpad)
                      @case(1)
                          
                      <a href="/bpkpad/pengajuan/{{$item->id}}" class="btn btn-xs btn-primary"><i class="fa fa-hourglass"></i></a>
                          @break
                      @case(2)
                          
                      <a href="/bpkpad/pengajuan/{{$item->id}}/detail" class="btn btn-xs btn-success"><i class="fa fa-check"></i></a>
                          @break
                      @default
                          
                      <a href="#" class="btn btn-xs bg-gray"><i class="fa fa-hourglass"></i></a>
                  @endswitch
                </td>
              </tr>
              @endforeach
            
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>


@endsection
@push('js')

@endpush
