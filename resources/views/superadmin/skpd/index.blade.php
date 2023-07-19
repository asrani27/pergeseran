@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        
        <div class="box box-success">
          <div class="box-header">
            <i class="fa fa-institution"></i><h3 class="box-title">Data SKPD</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>Kode SKPD</th>
                <th>Nama SKPD</th>
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$key + 1}}</td>
                <td>{{$item->kode_skpd}}</td>
                <td>{{$item->nama}}</td>
                <td>
                    @if ($item->user == null)
                    <a href="/superadmin/skpd/createakun/{{$item->id}}" class="btn btn-xs btn-default"><i
                            class="fa fa-key"></i> Buat Akun SKPD</a>
                    {{-- <a href="/superadmin/skpd/kepala/createakun/{{$item->id}}" class="btn btn-xs btn-default"><i
                            class="fa fa-key"></i> Buat Akun Kepala SKPD</a> --}}
                    @else
                    <a href="/superadmin/skpd/resetakun/{{$item->id}}" class="btn btn-xs bg-teal-active"><i
                            class="fa fa-key"></i> Reset Akun SKPD</a>
                    {{-- <a href="/superadmin/skpd/kepala/resetakun/{{$item->id}}" class="btn btn-xs bg-teal-active"><i
                            class="fa fa-key"></i> Reset Akun Kepala SKPD</a> --}}
                    @endif
                </td>
              </tr>
              @endforeach
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        
    </div>
</div>
@endsection
@push('js')

@endpush
