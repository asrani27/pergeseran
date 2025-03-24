@extends('layouts.app')
@push('css')

@endpush
@section('content')
<div class="row">
  <div class="col-md-12">

    {{-- <a href="/superadmin/ssh/upload" class="btn btn-sm btn-primary"><i class="fa fa-key"></i>
      Upload</a><br /><br /> --}}
    <div class="box box-success">
      <div class="box-header">
        <i class="fa fa-institution"></i>
        <h3 class="box-title">Data Satuan</h3>

        <div class="box-tools">
          <form method="get" action="/superadmin/satuan/search">
            @csrf
            <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
              <input type="text" name="search" class="form-control pull-right" value="{{old('search')}}"
                placeholder="Satuan">
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
          <tbody>
            <tr>
              <th>No</th>
              <th>Nama Satuan</th>
            </tr>
            @foreach ($data as $key => $item)
            <tr>
              <td>{{$key + 1}}</td>
              <td>{{$item->nama}}</td>

            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    {{$data->links()}}

  </div>
</div>
@endsection
@push('js')

@endpush