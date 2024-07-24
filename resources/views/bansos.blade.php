@extends('home.main')
@section('content')
<div class="col-md-4">
    <div class="panel panel">
        <div class="panel-heading">
            <h3 class="text-center">{{ isset($editBansos) ? 'Edit Data' : 'Tambah Data' }}</h3>
        </div>
        <div class="panel-body">
            <form action="{{ isset($editBansos) ? url('/bansos/'.$editBansos->id) : url('/bansos') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ isset($editBansos) ? $editBansos->nama : '' }}">
                </div>
                <button type="submit" class="btn btn-info btn-block">
                    {{ isset($editBansos) ? 'Update' : 'Simpan' }}
                </button>
            </form>
        </div>
    </div>
</div>
<div class="col-md-8">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="text-center">DAFTAR BANTUAN SOSIAL</h3>
        </div>
        <div class="panel-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bansos as $tampil)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tampil->nama }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="/bansos/{{ $tampil->id }}/edit" class="btn btn-warning btn-xs">Edit</a>
                                <form action="/bansos/{{ $tampil->id }}" method="POST" style="display:inline;">
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
