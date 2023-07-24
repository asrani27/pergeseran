@extends('layouts.app')
@push('css')
    
@endpush
@section('content')
<section class="content">
  <div class="row text-center">
    <h1><strong>GANTI PASSWORD</strong></h1>
  </div>
  
  <div class="row">
    <div class="col-xs-12">
      <div class="box" style="border-top-color: #008080">
      
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-hover">
            <tbody>
              <div class="col-xs-12">
                  <div class="form-group">
                  <label>Password Baru</label>
                  <input type="text" class="form-control" name="password1">
                  </div>
              </div>
              <div class="col-xs-12">
                  <div class="form-group">
                  <label>Masukkan Lagi Password Baru</label>
                  <input type="text" class="form-control" name="password2">
                  </div>
              </div>
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
