@extends('home.main')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-{{ isset($pengajuanEdit) ? 'warning' : 'info' }}">
            <div class="panel-heading">
                <h3 class="text-center">{{ isset($pengajuanEdit) ? 'EDIT' : 'TAMBAH' }}</h3>
            </div>
            <div class="panel-body">
                <form action="{{ isset($pengajuanEdit) ? route('pengajuan.update', $pengajuanEdit->id) : route('pengajuan.store') }}" method="POST">
                    @csrf
                    @if(isset($pengajuanEdit))
                        @method('PUT')
                    @endif

                    <div class="form-group">
                        <label for="warga_id">Warga</label>
                        @if(isset($pengajuanEdit))
                            <input type="text" name="warga_id" value="{{ $pengajuanEdit->warga->nama }}" class="form-control" readonly>
                        @else
                            <select class="form-control" name="warga_id">
                                <option value="">---</option>
                                @foreach ($warga as $data)
                                    <option value="{{ $data->id }}" {{ isset($pengajuanEdit) && $pengajuanEdit->warga_id == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="bansos_id">Bansos</label>
                        @if(isset($pengajuanEdit))
                            <input type="text" value="{{ $pengajuanEdit->bansos->nama }}" class="form-control" readonly>
                            <input type="hidden" name="bansos_id" value="{{ $pengajuanEdit->bansos_id }}">
                        @else
                            <select class="form-control" name="bansos_id" id="bansos_id">
                                <option value="">---</option>
                                @foreach ($bansos as $data)
                                    <option value="{{ $data->id }}" {{ isset($pengajuanEdit) && $pengajuanEdit->bansos_id == $data->id ? 'selected' : '' }}>{{ $data->nama }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>

                    <div id="kriteria-fields">
                        <!-- Kriteria fields will be injected here by JavaScript -->
                    </div>

                    <button type="submit" id="btn-simpan" class="btn btn-{{ isset($pengajuanEdit) ? 'warning' : 'info' }} btn-block">
                        {{ isset($pengajuanEdit) ? 'Simpan' : 'Tampilkan' }}
                    </button>

                    @if(isset($pengajuanEdit))
                        <a href="{{ route('pengajuan.index') }}" class="btn btn-info btn-block">Batal</a>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="text-center">DAFTAR</h3>
            </div>
            <div class="panel-body">
                <table class="table table-condensed">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Bansos</th>
                            <th>Kriteria</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengajuans as $index => $pengajuan)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pengajuan->warga->nik }}</td>
                                <td>{{ $pengajuan->warga->nama }}</td>
                                <td>{{ $pengajuan->bansos->nama }}</td>
                                <td>{{ $pengajuan->kriteria->nama }}</td>
                                <td>{{ $pengajuan->nilai }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('pengajuan.edit', $pengajuan->id) }}" class="btn btn-warning btn-xs">Edit</a>
                                        <form action="{{ route('pengajuan.destroy', $pengajuan->id) }}" method="POST" style="display:inline;">
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
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#bansos_id').change(function() {
        var bansosId = $(this).val();

        if (bansosId) {
            $.ajax({
                url: '{{ route('fetch.kriteria') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    bansos_id: bansosId
                },
                success: function(response) {
                    $('#kriteria-fields').html(response.html);
                    $('#btn-simpan').show(); // Show save button
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengambil data kriteria.');
                }
            });
        } else {
            $('#kriteria-fields').empty();
            $('#btn-simpan').hide(); // Hide save button if no bansos_id
        }
    });
});
</script>
@endpush
@endsection
