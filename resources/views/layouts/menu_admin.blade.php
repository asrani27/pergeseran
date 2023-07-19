<li class="{{ (request()->is('admin/beranda')) ? 'active' : '' }}"><a href="/admin/beranda"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
{{-- <li class="{{ (request()->is('admin/bidang*')) ? 'active' : '' }}"><a href="/admin/bidang"><i class="fa fa-institution"></i> <span>Bidang</span></a></li> --}}
<li class="{{ (request()->is('admin/pengajuan*')) ? 'active' : '' }}"><a href="/admin/pengajuan"><i class="fa fa-send"></i> <span>Pengajuan Baru</span></a></li>
