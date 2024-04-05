@extends('layouts.app')
@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="/assets/bower_components/select2/dist/css/select2.min.css">
    
@endpush
@section('content')
<section class="content">
  <div class="row text-center">
    <h1><strong>Pilih Rekening Yang Di kunci</strong></h1>
  </div>
  
  
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box">
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="/superadmin/kunci_rekening/add" enctype="multipart/form-data">
            @csrf
          <div class="box-body">
            <div class="col-xs-12">
                <div class="form-group">
                <label>Rekening </label>
                <select class="form-control" name="kode" required>
                  <option value="">pilih</option>
                  @foreach ($rekening as $item)
                      <option value="{{$item->kode}}">{{$item->kode}} - {{$item->nama}}</option>
                  @endforeach
                </select>
                </div>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer text-center">
            <button type="submit" class="btn btn-primary"> <i class="fa fa-upload"></i>  Kirim</button>
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
