@extends('home.main')
@section('content')
<div class="col-md-4">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="text-center">{{ isset($bobotEdit) ? 'EDIT' : 'TAMBAH' }}</h3>
        </div>
        <div class="panel-body">
            <form action="{{ isset($bobotEdit) ? route('bobot.update', $bobotEdit->id) : route('bobot.store') }}" method="POST">
                @csrf
                @if(isset($bobotEdit))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="bansos_id">Bantuan Sosial</label>
                    <select class="form-control" name="bansos_id">
                        <option value="">---</option>
                        @foreach ($bansos as $data)
                            <option value="{{ $data->id }}" {{ isset($bobotEdit) && $bobotEdit->bansos_id == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="kriteria_id">Kriteria</label>
                    <select class="form-control" name="kriteria_id">
                        <option value="">---</option>
                        @foreach ($kriteria as $data)
                            <option value="{{ $data->id }}" {{ isset($bobotEdit) && $bobotEdit->kriteria_id == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="bobot">Bobot</label>
                    <input type="text" name="bobot" class="form-control" value="{{ isset($bobotEdit) ? $bobotEdit->bobot : '' }}">
                </div>
                <button type="submit" class="btn btn-info btn-block">{{ isset($bobotEdit) ? 'Update' : 'Simpan' }}</button>
            </form>
        </div>
    </div>
</div>
<div class="col-md-8">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="text-center">DAFTAR BOBOT</h3>
        </div>
        <div class="panel-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bantuan Sosial</th>
                        <th>Kriteria</th>
                        <th>Bobot</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bobot as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->bansos->nama }}</td>
                        <td>{{ $item->kriteria->nama }}</td>
                        <td>{{ $item->bobot }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('bobot.edit', $item->id) }}" class="btn btn-warning btn-xs">Edit</a>
                                <form action="{{ route('bobot.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
