@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<div class="row">
    <div class="col-md-12">
        
      <a href="/admin/surat/add" class="btn btn-sm btn-primary"><i
        class="fa fa-plus"></i> Buat Surat</a><br/><br/>
        <div class="box box-success">
          <div class="box-header">
            <i class="fa fa-institution"></i><h3 class="box-title">Data Pembuatan Surat</h3>
          </div>
          
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tbody><tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Aksi</th>
              </tr>
              @foreach ($data as $key => $item)
              <tr>
                <td>{{$key + 1}}</td>
                <td>{{$item->nomor}}</td>
                <td>
                    {{-- <a href="/superadmin/kunci_rekening/edit/{{$item->id}}" class="btn btn-xs btn-default"><i
                            class="fa fa-edit"></i> Edit</a> --}}
                    <a href="/admin/surat/print/{{$item->id}}" class="btn btn-xs bg-red-active"><i
                              class="fa fa-print"></i> Cetak</a>
                    <a href="/admin/surat/delete/{{$item->id}}" class="btn btn-xs bg-red-active"><i
                            class="fa fa-trash"></i> Delete</a>
                    
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
