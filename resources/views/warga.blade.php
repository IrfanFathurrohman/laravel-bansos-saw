@extends('home.main')
@section('content')
<div class="col-md-4">
    <div class="panel panel">
        <div class="panel-heading">
            <h3 class="text-center">{{ isset($editWarga) ? 'Edit Data' : 'Tambah Data' }}</h3>
        </div>
        <div class="panel-body">
            <form action="{{ isset($editWarga) ? url('/warga/'.$editWarga->id) : url('/warga') }}" method="POST">
                @csrf
                @if(isset($editWarga))
                    @method('POST')
                @endif
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input type="text" name="nik" class="form-control" value="{{ isset($editWarga) ? $editWarga->nik : '' }}">
                </div>
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="{{ isset($editWarga) ? $editWarga->nama : '' }}">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control" value="{{ isset($editWarga) ? $editWarga->alamat : '' }}">
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin">
                        <option>---</option>
                        <option value="Laki-laki" {{ isset($editWarga) && $editWarga->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ isset($editWarga) && $editWarga->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-info btn-block">{{ isset($editWarga) ? 'Update' : 'Simpan' }}</button>
            </form>
        </div>
    </div>
</div>
<div class="col-md-8">
    <div class="panel panel-info">
        <div class="panel-heading"><h3 class="text-center">DAFTAR WARGA</h3></div>
        <div class="panel-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($warga as $tampil)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tampil->nik }}</td>
                        <td>{{ $tampil->nama }}</td>
                        <td>{{ $tampil->alamat }}</td>
                        <td>{{ $tampil->jenis_kelamin }}</td>
                        <td>{{ $tampil->tahun_pengajuan }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="/warga/{{ $tampil->id }}/edit" class="btn btn-warning btn-xs">Edit</a>
                                <form action="/warga/{{ $tampil->id }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('form[method="POST"][style="display:inline;"]');
    forms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
            if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                event.preventDefault();
            }
        });
    });
});
</script>
@endsection
