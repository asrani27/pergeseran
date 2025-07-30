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
                <input type="text" class="form-control" value="{{$data->skpd->nama}}" readonly>
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
                <textarea rows="4" class="form-control" value="{{$data->pengantar}}"
                  readonly>{{$data->pengantar}}</textarea>
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
                <input type="text" class="form-control"
                  value="{{$data->kode_program}} {{namaProgram($data->kode_program)}}" readonly>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label>Kegiatan</label>
                <input type="text" class="form-control"
                  value="{{$data->kode_kegiatan}} {{namaKegiatan($data->kode_kegiatan)}}" readonly>
              </div>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label>Sub Kegiatan</label>
                <input type="text" class="form-control"
                  value="{{$data->kode_subkegiatan}} {{namaSubkegiatan($data->kode_subkegiatan)}}" readonly>
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
                        <table class="table table-condensed">
                          <tr style="background-color: aquamarine;">
                            <th style="border:1px solid black">No</th>
                            <th style="border:1px solid black">Rekening Awal</th>
                            <th style="border:1px solid black">Jenis SSH</th>
                            <th style="border:1px solid black">Spesifikasi Komponen</th>
                            <th style="border:1px solid black">Satuan</th>
                            <th style="border:1px solid black">Harga</th>
                            <th style="border:1px solid black">Koefisien</th>
                            <th style="border:1px solid black">Total</th>
                            <th style="border:1px solid black"></th>
                          </tr>
                          @foreach ($sesudah as $key => $item)
                          <tr>
                            <td style="border:1px solid black">{{$key+1}}</td>
                            <td style="border:1px solid black">{{$item->kode_rekening}}<br />
                              {{namaRekening($item->kode_rekening)}}
                            </td>
                            <td style="border:1px solid black">{{$item->jenis_ssh}}</td>
                            <td style="border:1px solid black">{{$item->kode_komponen}}<br />
                              {{namaKomponen($item->kode_komponen)->uraian}}
                              {{namaKomponen($item->kode_komponen)->spesifikasi}}
                            </td>
                            <td style="border:1px solid black">{{$item->satuan}}</td>
                            <td style="border:1px solid black; text-align:right;">{{number_format($item->harga)}}</td>
                            <td style="border:1px solid black">
                              Koefisien : <br />
                              {{$item->koefisien1}} {{$item->satuan1}} <br />
                              {{$item->koefisien2}} {{$item->satuan2}} <br />
                              {{$item->koefisien3}} {{$item->satuan3}} <br />
                            </td>
                            <td style="border:1px solid black; text-align:right;">{{number_format($item->total)}}</td>
                            <td style="border:1px solid black">
                              @if ($data->status_operator != 2)
                              <a href="/admin/beranda/hapussesudah/{{$item->id}}" class="btn btn-xs btn-danger"
                                onclick="return confirm(' Yakin ingin di hapus?');">
                                <i class="fa fa-times"></i> Hapus
                              </a>
                              @endif
                            </td>
                          </tr>
                          @endforeach
                          <tr>
                            <td style="border:1px solid black; text-align:right; font-weight:bold" colspan=7>TOTAL</td>
                            <td style="border:1px solid black; text-align:right;">
                              {{number_format($sesudah->sum('total'))}}</td>
                          </tr>
                        </table>

                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer with-border">

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

                        <table class="table table-condensed">
                          <tr style="background-color: aquamarine;">
                            <th style="border:1px solid black">No</th>
                            <th style="border:1px solid black">Rekening Awal</th>
                            <th style="border:1px solid black">Jenis SSH</th>
                            <th style="border:1px solid black">Spesifikasi Komponen</th>
                            <th style="border:1px solid black">Satuan</th>
                            <th style="border:1px solid black">Harga</th>
                            <th style="border:1px solid black">Koefisien</th>
                            <th style="border:1px solid black">Total</th>
                            <th style="border:1px solid black"></th>
                          </tr>
                          @foreach ($sesudah as $key => $item)
                          <tr>
                            <td style="border:1px solid black">{{$key+1}}</td>
                            <td style="border:1px solid black">{{$item->kode_rekening}}<br />
                              {{namaRekening($item->kode_rekening)}}
                            </td>
                            <td style="border:1px solid black">{{$item->jenis_ssh}}</td>
                            <td style="border:1px solid black">{{$item->kode_komponen}}<br />
                              {{namaKomponen($item->kode_komponen)->uraian}}
                              {{namaKomponen($item->kode_komponen)->spesifikasi}}
                            </td>
                            <td style="border:1px solid black">{{$item->satuan}}</td>
                            <td style="border:1px solid black; text-align:right;">{{number_format($item->harga)}}</td>
                            <td style="border:1px solid black">
                              Koefisien : <br />
                              {{$item->koefisien1}} {{$item->satuan1}} <br />
                              {{$item->koefisien2}} {{$item->satuan2}} <br />
                              {{$item->koefisien3}} {{$item->satuan3}} <br />
                            </td>
                            <td style="border:1px solid black; text-align:right;">{{number_format($item->total)}}</td>
                            <td style="border:1px solid black">
                              @if ($data->status_operator != 2)
                              <a href="/admin/beranda/hapussesudah/{{$item->id}}" class="btn btn-xs btn-danger"
                                onclick="return confirm(' Yakin ingin di hapus?');">
                                <i class="fa fa-times"></i> Hapus
                              </a>
                              @endif
                            </td>
                          </tr>
                          @endforeach
                          <tr>
                            <td style="border:1px solid black; text-align:right; font-weight:bold" colspan=7>TOTAL</td>
                            <td style="border:1px solid black; text-align:right;">
                              {{number_format($sesudah->sum('total'))}}</td>
                          </tr>
                        </table>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer with-border">

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
          <!-- /.box-body -->

          <div class="box-footer text-center">
            @if ($data->status_bpkpad == 2)
            <button type="button" class="btn btn-success"> <i class="fa fa-check"></i> Pengajuan
              Disetujui</button>
            @else
            <button type="button" class="btn btn-danger"> <i class="fa fa-times"></i> Pengajuan
              Ditolak</button>
            @endif

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