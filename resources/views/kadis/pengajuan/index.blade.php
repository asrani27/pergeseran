@extends('layouts.app')
@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="/assets/bower_components/select2/dist/css/select2.min.css">
    
@endpush
@section('content')
<section class="content">
  <div class="row text-center">
    <h1><strong>DETAIL PENGAJUAN PERGESERAN</strong></h1>
  </div>
  
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box">
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="/pimpinan/pengajuan/1">
            @csrf
          <div class="box-body">
            <div class="col-xs-6">
              <div class="form-group">
              <label>No Surat</label>
              <input type="text" class="form-control" placeholder="no surat" readonly value="{{$data->nomor_surat}}">
              </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" name="tanggal" readonly value="{{$data->tanggal}}">
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                <label>Dari</label>
                <input type="text" class="form-control" value="{{Auth::user()->kepala->nama}}" readonly>
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
                <textarea rows="4" class="form-control"  value="{{$data->pengantar}}" readonly>{{$data->pengantar}}</textarea>
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
                          
                          <div class="col-xs-6">
                              <div class="form-group">
                              <label>Rekening Awal</label>
                              <select class="form-control select2" style="width: 100%;" disabled name="sebelum_a">
                                @foreach ($rekening as $item)
                                <option value="{{$item->id}}" {{$item->id == $data->detail->first()->sebelum_a ? 'selected':''}}>{{$item->kode}} - {{$item->nama}}</option>
                                @endforeach
                              </select>
                              </div>
                          </div>
                          <div class="col-xs-2">
                              <div class="form-group">
                              <label>Jumlah</label>
                              <input type="text" class="form-control" placeholder="jumlah" disabled value="{{$data->detail->first()->sebelum_b}}">
                              </div>
                          </div>
                          <div class="col-xs-4">
                              <div class="form-group">
                              <label>Nominal Rekening Awal</label>
                              <input type="text" class="form-control" placeholder="nominal" readonly value="{{$data->detail->first()->sebelum_c}}">
                              </div>
                          </div>
                          
                          <div class="col-xs-6">
                              <div class="form-group">
                              <label>Standar Satuan Harga</label>
                              <select class="form-control select2" style="width: 100%;" disabled name="sebelum_d">
                                @foreach ($ssh as $item)
                                <option value="{{$item->id}}" {{$item->id == $data->detail->first()->sebelum_d ? 'selected':''}}>{{$item->kode}} - {{$item->uraian}} - Rp. {{$item->harga}}</option>
                                @endforeach
                              </select>
                              </div>
                          </div>
                          <div class="col-xs-2">
                              <div class="form-group">
                              <label>Jumlah</label>
                              <input type="text" class="form-control" disabled value="{{$data->detail->first()->sebelum_e}}">
                              </div>
                          </div>
                          <div class="col-xs-4">
                              <div class="form-group">
                              <label>Nominal Standar Satuan Harga</label>
                              <input type="text" class="form-control" readonly value="{{$data->detail->first()->sebelum_f}}">
                              </div>
                          </div>
                        </div>
                        <!-- /.box-body -->
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
                          
                          <div class="col-xs-6">
                              <div class="form-group">
                              <label>Diganti Menjadi</label>
                              <select class="form-control select2" style="width: 100%;" disabled  name="setelah_a">
                                @foreach ($rekening as $item)
                                <option value="{{$item->id}}" {{$item->id == $data->detail->first()->setelah_a ? 'selected':''}}>{{$item->kode}} - {{$item->nama}}</option>
                                @endforeach
                              </select>
                              </div>
                          </div>
                          <div class="col-xs-2">
                              <div class="form-group">
                              <label>Jumlah</label>
                              <input type="text" class="form-control" placeholder="jumlah" disabled value="{{$data->detail->first()->setelah_b}}">
                              </div>
                          </div>
                          <div class="col-xs-4">
                              <div class="form-group">
                              <label>Nominal Rekening Akhir</label>
                              <input type="text" class="form-control" placeholder="nominal" readonly value="{{$data->detail->first()->setelah_c}}">
                              </div>
                          </div>
                          
                          <div class="col-xs-6">
                              <div class="form-group">
                              <label>Standar Satuan Harga</label>
                              <select class="form-control select2" style="width: 100%;" disabled name="setelah_d">
                                @foreach ($ssh as $item)
                                <option value="{{$item->id}}" {{$item->id == $data->detail->first()->setelah_d ? 'selected':''}}>{{$item->kode}} - {{$item->uraian}} - Rp. {{$item->harga}}</option>
                                @endforeach
                              </select>
                              </div>
                          </div>
                          <div class="col-xs-2">
                              <div class="form-group">
                              <label>Jumlah</label>
                              <input type="text" class="form-control" placeholder="jumlah" disabled value="{{$data->detail->first()->setelah_e}}">
                              </div>
                          </div>
                          <div class="col-xs-4">
                              <div class="form-group">
                              <label>Nominal Standar Satuan Harga</label>
                              <input type="text" class="form-control" readonly value="{{$data->detail->first()->setelah_f}}">
                              </div>
                          </div>
                        </div>
                        <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                    </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
          </div>
          <!-- /.box-body -->
          {{-- /pimpinan/pengajuan/{{$data->id}}/terima --}}
          <div class="box-footer text-center">
            <button type="button" class="btn btn-danger kadis-menolak" data-id="{{$data->id}}"> <i class="fa fa-times"></i>  Tolak Pengajuan</button>
            <button type="button" class="btn btn-primary kadis-menerima" data-id="{{$data->id}}"> <i class="fa fa-send"></i>  Terima Pengajuan</button>
          </div>
        </form>
      </div>
      
  </div>
</section>

<div class="modal fade" id="modal-tolak">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-red">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="ion ion-clipboard"></i> Tolak Pengajuan</h4>
      </div>
      <form method="post" action="/pimpinan/pengajuan/tolak">
      <div class="modal-body">
          @csrf
          <div class="form-group">
              <label>Alasan Menolak</label>
              <textarea class="form-control" name="ket_kepala_skpd" rows="4"></textarea>
              <input type="hidden" name="tolak_id" id="tolak_id">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-grey pull-left" data-dismiss="modal"><i class="fa fa-sign-out"></i> Close</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-terima">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="ion ion-clipboard"></i> Terima Pengajuan</h4>
      </div>
      <form method="post" action="/pimpinan/pengajuan/terima">
      <div class="modal-body">
          @csrf
          <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" name="ket_kepala_skpd" rows="4"></textarea>
              <input type="hidden" name="terima_id" id="terima_id">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-grey pull-left" data-dismiss="modal"><i class="fa fa-sign-out"></i> Close</button>
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection
@push('js')
<script>
  $(document).on('click', '.kadis-menolak', function() { 
    $('#tolak_id').val($(this).data('id'));
  $("#modal-tolak").modal();
});
</script>
<script>
  $(document).on('click', '.kadis-menerima', function() {
    $('#terima_id').val($(this).data('id'));
  $("#modal-terima").modal();
});
</script>
<!-- Select2 -->
<script src="/assets/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
@endpush
