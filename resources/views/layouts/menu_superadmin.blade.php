<li class="{{ (request()->is('superadmin/beranda')) ? 'active' : '' }}"><a href="/superadmin/beranda"><i
            class="fa fa-home"></i> <span>Dashboard</span></a></li>
<li class="{{ (request()->is('superadmin/skpd*')) ? 'active' : '' }}"><a href="/superadmin/skpd"><i
            class="fa fa-institution"></i> <span>SKPD</span></a></li>
<li class="{{ (request()->is('superadmin/ssh*')) ? 'active' : '' }}"><a href="/superadmin/ssh"><i
            class="fa fa-list"></i> <span>SSH</span></a></li>
<li class="{{ (request()->is('superadmin/satuan*')) ? 'active' : '' }}"><a href="/superadmin/satuan"><i
            class="fa fa-list"></i> <span>Satuan</span></a></li>
<li class="{{ (request()->is('superadmin/kunci_rekening*')) ? 'active' : '' }}"><a href="/superadmin/kunci_rekening"><i
            class="fa fa-list"></i> <span>Kunci Rekening</span></a></li>
<li class="{{ (request()->is('superadmin/importdata*')) ? 'active' : '' }}"><a href="/superadmin/importdata"><i
            class="fa fa-upload"></i> <span>Import Data</span></a></li>