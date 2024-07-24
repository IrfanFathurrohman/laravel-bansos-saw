<div class="container-fluid">
  <div class="navbar-header">
      <a class="navbar-brand" href="#">SPK</a>
  </div>
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
          <li><a href="/dashboard">Beranda <span class="sr-only">(current)</span></a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" style="font-weight: bold; color: green;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Perhitungan <span class="caret"></span></a>
            <ul class="dropdown-menu">
                @foreach ($bansos as $data)
                    <li><a href="#">{{ $data->nama }}</a></li>
                @endforeach
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kelola Data <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/bansos">Data Bansos</a></li>
              <li class="divider"></li>
              <li><a href="/warga">Data Warga</a></li>
              <li><a href="/kriteria">Kriteria</a></li>
              <li><a href="/bobot">Bobot</a></li>
              <li><a href="/penilaian">Penilaian</a></li>
              <li class="divider"></li>
              <li><a href="/pengajuan">Pengajuan</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laporan <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/lap_seluruh">Seluruh Warga</a></li>
              <li><a href="/lap_warga">Per Warga</a></li>
              <li><a href="/lap_pengajuan">Pengajuan</a></li>
            </ul>
          </li>
          <!-- <li><a href="?page=pengumuman">Pengumuman</a></li> -->
          <li><a href="logout.php">Logout</a></li>
          <li><a href="#">|</a></li>
          <li><a href="#" style="font-weight: bold; color: red;"></a></li>
      </ul>
  </div>
</div>
