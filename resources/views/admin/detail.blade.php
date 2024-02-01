@extends('layouts.app')
@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="/assets/bower_components/select2/dist/css/select2.min.css">
    
@endpush
@section('content')
<section class="content">
  <div class="row text-center">
    <h1><strong>DETAIL PENGAJUAN</strong></h1>
  </div>
  
  
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box">
        <!-- /.box-header -->
        <!-- form start -->
          <div class="box-body">
            <div class="col-xs-6">
                <div class="form-group">
                <label>No Surat</label>
                <input type="text" class="form-control" placeholder="no surat" value="{{$data->nomor_surat}}" readonly>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" name="tanggal" value="{{$data->tanggal}}">
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
                  <select class="form-control select2" style="width: 100%;" disabled name="tipe_pengajuan">
                    <option selected="">Pilih Tipe Pengajuan Perubahan</option>
                    <option value="1" {{$data->tipe_pengajuan == '1' ? 'selected':''}}>Antar Objek</option>
                    <option value="2" {{$data->tipe_pengajuan == '2' ? 'selected':''}}>Antar Rincian Objek</option>
                    <option value="3" {{$data->tipe_pengajuan == '3' ? 'selected':''}}>Antar Sub Rincian Objek</option>
                    <option value="4" {{$data->tipe_pengajuan == '4' ? 'selected':''}}>Perubahan Uraian</option>
                  </select>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                <label>Hal</label>
                <input type="text" class="form-control" placeholder="hal" readonly value="{{$data->hal}}">
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                <label>Kalimat pengantar</label>
                <textarea rows="4" class="form-control"  readonly>{{$data->pengantar}}</textarea>
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
                  <select class="form-control select2" style="width: 100%;" disabled>
                    @foreach ($program as $item)
                    <option value="{{$item->id}}" {{$item->id == $data->id ? 'selected':''}}>{{$item->kode}} - {{$item->nama}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                <label>Kegiatan</label>
                  <select class="form-control select2" style="width: 100%;" disabled name="kegiatan">
                    
                    @foreach ($kegiatan as $item)
                    <option value="{{$item->id}}" {{$item->id == $data->id ? 'selected':''}}>{{$item->kode}} - {{$item->nama}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                <label>Sub Kegiatan</label>
                  <select class="form-control select2" style="width: 100%;" disabled name="subkegiatan">
                    @foreach ($subkegiatan as $item)
                    <option value="{{$item->id}}" {{$item->id == $data->id ? 'selected':''}}>{{$item->kode}} - {{$item->nama}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-xs-12">
              <div class="box box-primary box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Perubahan Rekening</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                    <div class="col-xs-12">
                      <div class="box box-info box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Sebelum Dirubah</h3>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                          
    
                  <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-default">
                    Tambah
                   </button><br/>
                          <table class="table table-condensed">
                            <tr style="background-color: aquamarine">
                              <th>No</th>
                              <th>Rekening Awal</th>
                              <th>Jumlah</th>
                              <th>Nominal</th>
                            </tr>
                            @foreach ($sebelum as $key => $item)
                            <tr>
                              <td>{{$key+1}}</td>
                              <td>{{$item->rekawal}}</td>
                              <td>{{$item->jumlah}}</td>
                              <td>{{$item->nominal}}
                                <a href="/admin/beranda/rekawal/{{$item->id}}" class="btn btn-xs btn-primary" onclick="return confirm(' Yakin ingin di hapus?');">
                                  Hapus
                                </a>
                              </td>
                            </tr>
                            @endforeach


                            <tr style="background-color: aquamarine">
                              <th>No</th>
                              <th>SSH</th>
                              <th>Satuan</th>
                              <th>Nominal</th>
                            </tr>
                            @foreach ($sebelum as $key => $item)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->ssh}}</td>
                            <td>{{$item->satuan}}</td>
                            <td>{{number_format($item->nominalssh)}}</td>
                          </tr>
                          @endforeach
                          </table>
                          
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer with-border">
                        Total : {{number_format($sebelum->sum('total'))}}
                        </div>
                      </div>
                      <!-- /.box -->
                    </div>
                    <div class="col-xs-12">
                      <div class="box box-info box-solid">
                        <div class="box-header with-border">
                          <h3 class="box-title">Setelah Dirubah</h3>
                          <!-- /.box-tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">

    
                  <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modal-default2">
                    Tambah
                   </button><br/>
                   <table class="table table-condensed">
                     <tr style="background-color: aquamarine">
                       <th>No</th>
                       <th>Rekening Awal</th>
                       <th>Jumlah</th>
                       <th>Nominal</th>
                     </tr>
                     @foreach ($sesudah as $key => $item)
                     <tr>
                       <td>{{$key+1}}</td>
                       <td>{{$item->rekawal}}</td>
                       <td>{{$item->jumlah}}</td>
                       <td>{{$item->nominal}}
                         <a href="/admin/beranda/rekawal/{{$item->id}}" class="btn btn-xs btn-primary" onclick="return confirm(' Yakin ingin di hapus?');">
                           Hapus
                         </a>
                       </td>
                     </tr>
                     @endforeach


                     <tr style="background-color: aquamarine">
                       <th>No</th>
                       <th>SSH</th>
                       <th>Satuan</th>
                       <th>Nominal</th>
                     </tr>
                     @foreach ($sesudah as $key => $item)
                   <tr>
                     <td>{{$key+1}}</td>
                     <td>{{$item->ssh}}</td>
                     <td>{{$item->satuan}}</td>
                     <td>{{number_format($item->nominalssh)}}</td>
                   </tr>
                   @endforeach
                   </table>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer with-border">
                        Total : {{number_format($sesudah->sum('total'))}}
                        </div>
                      </div>
                      <!-- /.box -->
                    </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
          </div>
      </div>
      
  </div>
</section>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Sebelum </h4>
      </div>
      <div class="modal-body">
        <form method="post" action="/admin/beranda/detail/{{$data->id}}/sebelum">
          @csrf
          <div class="col-xs-9">
              <div class="form-group">
              <label>Rekening Awal</label>
              <select id="rekeningawal" class="form-control select2" style="width: 100%;" required name="rekawal">
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
              <input type="text" class="form-control" placeholder="jumlah" required name="jumlah">
              </div>
          </div>
          
          <div class="col-xs-12">
              <div class="form-group">
              <label>Standar Satuan Harga</label>
              <select class="form-control select2" style="width: 100%;" required name="ssh">
                <option selected="">Pilih Standar Satuan Harga</option>
                @foreach ($ssh as $item)
                <option value="{{$item->id}}">{{$item->kode}} - {{$item->uraian}} - {{number_format($item->harga)}}</option>
                @endforeach
              </select>
              </div>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-default2">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Menjadi </h4>
      </div>
      <div class="modal-body">
        <form method="post" action="/admin/beranda/detail/{{$data->id}}/sesudah">
          @csrf
          <div class="col-xs-9">
              <div class="form-group">
              <label>Dirubah Menjadi</label>
              <select id="rekeningawal" class="form-control select2" style="width: 100%;" required name="rekawal">
                <option value="" selected>-pilih-</option>
                @foreach ($rekening as $item)
                <option value="{{$item->id}}">{{$item->kode}} - {{$item->nama}}</option>
                @endforeach
              </select>
              </div>
          </div>
          <div class="col-xs-3">
              <div class="form-group">
              <label>Jumlah</label>
              <input type="text" class="form-control" placeholder="jumlah" required name="jumlah">
              </div>
          </div>
          
          <div class="col-xs-12">
              <div class="form-group">
              <label>Standar Satuan Harga</label>
              <select class="form-control select2" style="width: 100%;" required name="ssh">
                <option selected="">Pilih Standar Satuan Harga</option>
                @foreach ($ssh as $item)
                <option value="{{$item->id}}">{{$item->kode}} - {{$item->uraian}} - {{number_format($item->harga)}}</option>
                @endforeach
              </select>
              </div>
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
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
@endpush
