@extends('home.main')

@section('content')
<div class="col-md-4">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="text-center">{{ isset($kriteria->id) ? 'EDIT KRITERIA' : 'TAMBAH KRITERIA' }}</h3>
        </div>
        <div class="panel-body">
            <form action="{{ isset($kriteria->id) ? route('kriteria.update', ['id' => $kriteria->id]) : route('kriteria.store') }}" method="POST">
                @csrf
                @if(isset($kriteria->id))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label>Bansos</label>
                    <select class="form-control" name="bansos_id">
                        <option value="">---</option>
                        @foreach ($bansos as $data)
                            <option value="{{ $data->id }}" {{ isset($kriteria->bansos_id) && $kriteria->bansos_id == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" class="form-control" value="{{ isset($kriteria->nama) ? $kriteria->nama : '' }}">
                </div>
                <div class="form-group">
                    <label for="sifat">Sifat</label>
                    <select class="form-control" name="sifat">
                        <option value="">---</option>
                        <option value="min" {{ isset($kriteria->sifat) && $kriteria->sifat == 'min' ? 'selected' : '' }}>Min</option>
                        <option value="max" {{ isset($kriteria->sifat) && $kriteria->sifat == 'max' ? 'selected' : '' }}>Max</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-info btn-block">{{ isset($kriteria->id) ? 'Update' : 'Simpan' }}</button>
            </form>
        </div>
    </div>        
</div>
<div class="col-md-8">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="text-center">DAFTAR KRITERIA</h3>
        </div>
        <div class="panel-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Beasiswa</th>
                        <th>Kriteria</th>
                        <th>Sifat</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kriteriaList as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->bansos->nama }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->sifat }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('kriteria.edit', $item->id) }}" class="btn btn-warning btn-xs">Edit</a>
                                <form action="{{ route('kriteria.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
@endsection
