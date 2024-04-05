@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        
      <a href="/superadmin/ssh/upload" class="btn btn-sm btn-primary"><i
        class="fa fa-key"></i> Upload</a><br/><br/>
        <div class="box box-success">
          <div class="box-header">
            <i class="fa fa-institution"></i><h3 class="box-title">Data SSH</h3>

            <div class="box-tools">
                <form method="get" action="/superadmin/ssh/search">
                    @csrf
                    <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                        <input type="text" name="search" class="form-control pull-right" value="{{old('search')}}" placeholder="Kode/Uraian">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>Kode</th>
                <th>Uraian</th>
                <th>Satuan</th>
                <th>Harga</th>
                <th>Jenis</th>
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$key + 1}}</td>
                <td>{{$item->kode}}</td>
                <td>{{$item->uraian}}</td>
                <td>{{$item->satuan}}</td>
                <td>{{number_format($item->harga)}}</td>
                <td>{{$item->jenis}}</td>
                <td>
                    {{-- @if ($item->user == null)
                    <a href="/superadmin/skpd/createakun/{{$item->id}}" class="btn btn-xs btn-default"><i
                            class="fa fa-key"></i> Buat Akun SKPD</a>
                    @else
                    <a href="/superadmin/skpd/resetakun/{{$item->id}}" class="btn btn-xs bg-teal-active"><i
                            class="fa fa-key"></i> Reset Akun SKPD</a>
                    @endif

                    @if ($item->kepala == null)
                    <a href="/superadmin/skpd/kepala/createakun/{{$item->id}}" class="btn btn-xs btn-default"><i
                            class="fa fa-key"></i> Buat Akun Pimpinan SKPD</a>
                    @else
                    <a href="/superadmin/skpd/kepala/resetakun/{{$item->id}}" class="btn btn-xs bg-teal-active"><i
                            class="fa fa-key"></i> Reset Akun Pimpinan SKPD</a>
                    @endif --}}
                </td>
              </tr>
              @endforeach
            </tbody></table>
          </div>
          <!-- /.box-body -->
        </div>
        {{$data->links()}}
        
    </div>
</div>
@endsection
@push('js')

@endpush
