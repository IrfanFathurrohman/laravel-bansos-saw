@extends('home.main')
@section('content')
<div class="col-md-4">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="text-center">{{ isset($penilaianEdit) ? 'EDIT' : 'TAMBAH' }}</h3>
        </div>
        <div class="panel-body">
            <form action="{{ isset($penilaianEdit) ? route('penilaian.update', $penilaianEdit->id) : route('penilaian.store') }}" method="POST">
                @csrf
                @if(isset($penilaianEdit))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="bansos_id">Bantuan Sosial</label>
                    <select class="form-control" name="bansos_id">
                        <option value="">---</option>
                        @foreach ($bansos as $data)
                            <option value="{{ $data->id }}" {{ isset($penilaianEdit) && $penilaianEdit->bansos_id == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="kriteria_id">Kriteria</label>
                    <select class="form-control" name="kriteria_id">
                        <option value="">---</option>
                        @foreach ($kriteria as $data)
                            <option value="{{ $data->id }}" {{ isset($penilaianEdit) && $penilaianEdit->kriteria_id == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" name="keterangan" class="form-control" value="{{ isset($penilaianEdit) ? $penilaianEdit->keterangan : '' }}">
                </div>
                <div class="form-group">
                    <label for="bobot">Bobot</label>
                    <input type="text" name="bobot" class="form-control" value="{{ isset($penilaianEdit) ? $penilaianEdit->bobot : '' }}">
                </div>
                <button type="submit" class="btn btn-info btn-block">{{ isset($penilaianEdit) ? 'Update' : 'Simpan' }}</button>
            </form>
        </div>
    </div>
</div>
<div class="col-md-8">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="text-center">DAFTAR PENILAIAN</h3>
        </div>
        <div class="panel-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bantuan Sosial</th>
                        <th>Kriteria</th>
                        <th>Keterangan</th>
                        <th>Bobot</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penilaian as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->bansos->nama }}</td>
                        <td>{{ $item->kriteria->nama }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td>{{ $item->bobot }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('penilaian.edit', $item->id) }}" class="btn btn-warning btn-xs">Edit</a>
                                <form action="{{ route('penilaian.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
