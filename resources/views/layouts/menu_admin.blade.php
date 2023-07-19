<li class="{{ (request()->is('admin/beranda')) ? 'active' : '' }}"><a href="/admin/beranda"><i class="fa fa-home"></i> <span>Beranda</span></a></li>
<li class="{{ (request()->is('admin/pengajuan*')) ? 'active' : '' }}"><a href="/admin/pengajuan"><i class="fa fa-send"></i> <span>Pengajuan Baru</span></a></li>
<li class="{{ (request()->is('admin/gantipass*')) ? 'active' : '' }}"><a href="/admin/gantipass"><i class="fa fa-key"></i> <span>Ganti Password</span></a></li>
