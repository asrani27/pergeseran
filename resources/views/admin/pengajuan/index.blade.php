@extends('layouts.app')
@push('css')
<!-- Select2 -->
<link rel="stylesheet" href="/assets/bower_components/select2/dist/css/select2.min.css">
    
@endpush
@section('content')
<section class="content">
  <div class="row text-center">
    <h1><strong>BUAT PENGAJUAN BARU</strong></h1>
    <h3>SILAHKAN ISI FORM DI BAWAH INI UNTUK MEMBUAT PENGAJUAN BARU</h3>
  </div>
  
  
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box">
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" action="/admin/pengajuan/create">
            @csrf
          <div class="box-body">
            <div class="col-xs-6">
                <div class="form-group">
                <label>No Surat</label>
                <input type="text" class="form-control" placeholder="no surat" name="nomor_surat">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                <label>Tanggal</label>
                <input type="date" class="form-control" name="tanggal" value="{{\Carbon\Carbon::today()->format('Y-m-d')}}">
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
                  <select class="form-control select2" style="width: 100%;" required name="tipe_pengajuan">
                    <option selected="">Pilih Tipe Pengajuan Perubahan</option>
                    <option value="1">Antar Objek</option>
                    <option value="2">Antar Rincian Objek</option>
                    <option value="3">Antar Sub Rincian Objek</option>
                    <option value="4">Perubahan Uraian</option>
                  </select>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                <label>Hal</label>
                <input type="text" class="form-control" placeholder="hal" name="hal">
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                <label>Kalimat pengantar</label>
                <textarea rows="4" class="form-control" name="pengantar"></textarea>
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
                  <select class="form-control select2" style="width: 100%;" required name="program">
                    <option value="" selected>Pilih Program</option>
                    @foreach ($program as $item)
                    <option value="{{$item->id}}">{{$item->kode}} - {{$item->nama}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                <label>Kegiatan</label>
                  <select class="form-control select2" style="width: 100%;" required name="kegiatan">
                    <option value="" selected>Pilih Kegiatan</option>
                    @foreach ($kegiatan as $item)
                    <option value="{{$item->id}}">{{$item->kode}} - {{$item->nama}}</option>
                    @endforeach
                  </select>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                <label>Sub Kegiatan</label>
                  <select class="form-control select2" style="width: 100%;" required name="subkegiatan">
                    <option value="" selected>Pilih SubKegiatan</option>
                    @foreach ($subkegiatan as $item)
                    <option value="{{$item->id}}">{{$item->kode}} - {{$item->nama}}</option>
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
                              <select class="form-control select2" style="width: 100%;" required name="sebelum_a">
                                <option value="" selected>Rekening Awal</option>
                                @foreach ($rekening as $item)
                                <option value="{{$item->id}}">{{$item->kode}} - {{$item->nama}}</option>
                                @endforeach
                              </select>
                              </div>
                          </div>
                          <div class="col-xs-2">
                              <div class="form-group">
                              <label>Jumlah</label>
                              <input type="text" class="form-control" placeholder="jumlah" required name="sebelum_b">
                              </div>
                          </div>
                          <div class="col-xs-4">
                              <div class="form-group">
                              <label>Nominal Rekening Awal</label>
                              <input type="text" class="form-control" placeholder="nominal" readonly name="sebelum_c">
                              </div>
                          </div>
                          
                          <div class="col-xs-6">
                              <div class="form-group">
                              <label>Standar Satuan Harga</label>
                              <select class="form-control select2" style="width: 100%;" required name="sebelum_d">
                                <option selected="">Pilih Standar Satuan Harga</option>
                                @foreach ($ssh as $item)
                                <option value="{{$item->id}}">{{$item->uraian}} - {{$item->spesifikasi}}</option>
                                @endforeach
                              </select>
                              </div>
                          </div>
                          <div class="col-xs-2">
                              <div class="form-group">
                              <label>Jumlah</label>
                              <input type="text" class="form-control" placeholder="jumlah" required name="sebelum_e">
                              </div>
                          </div>
                          <div class="col-xs-4">
                              <div class="form-group">
                              <label>Nominal Standar Satuan Harga</label>
                              <input type="text" class="form-control" readonly name="sebelum_f">
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
                              <select class="form-control select2" style="width: 100%;" required  name="setelah_a">
                                <option value="" selected>Rekening Awal</option>
                                @foreach ($rekening as $item)
                                <option value="{{$item->id}}">{{$item->kode}} - {{$item->nama}}</option>
                                @endforeach
                              </select>
                              </div>
                          </div>
                          <div class="col-xs-2">
                              <div class="form-group">
                              <label>Jumlah</label>
                              <input type="text" class="form-control" placeholder="jumlah" required name="setelah_b">
                              </div>
                          </div>
                          <div class="col-xs-4">
                              <div class="form-group">
                              <label>Nominal Rekening Akhir</label>
                              <input type="text" class="form-control" placeholder="nominal" readonly name="setelah_c">
                              </div>
                          </div>
                          
                          <div class="col-xs-6">
                              <div class="form-group">
                              <label>Standar Satuan Harga</label>
                              <select class="form-control select2" style="width: 100%;" required name="setelah_d">
                                <option selected="">Pilih Standar Satuan Harga</option>
                                @foreach ($ssh as $item)
                                <option value="{{$item->id}}">{{$item->uraian}} - {{$item->spesifikasi}}</option>
                                @endforeach
                              </select>
                              </div>
                          </div>
                          <div class="col-xs-2">
                              <div class="form-group">
                              <label>Jumlah</label>
                              <input type="text" class="form-control" placeholder="jumlah" required name="setelah_e">
                              </div>
                          </div>
                          <div class="col-xs-4">
                              <div class="form-group">
                              <label>Nominal Standar Satuan Harga</label>
                              <input type="text" class="form-control" readonly name="setelah_f">
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

          <div class="box-footer text-center">
            <button type="submit" class="btn btn-primary"> <i class="fa fa-send"></i>  Kirim</button>
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
