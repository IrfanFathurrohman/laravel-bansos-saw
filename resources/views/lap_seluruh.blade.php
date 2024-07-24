@extends('home.main')
@section('content')
<div class="col-md-12">
    <div class="panel panel-info">
        <div class="panel-heading"><h3 class="text-center">Laporan Nilai Seluruh Mahasiswa</h3></div>
        <div class="panel-body">
            <form class="form-inline" action="" method="post">
                <label for="tahun">Tahun :</label>
                <select class="form-control" name="tahun">
                    <option>---</option>
                    <option value="2017">2017</option>
                </select>
                <button type="submit" class="btn btn-primary">Tampilkan</button>
            </form>
            
            <hr>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Nilai Maksimal</th>
                        <th>Rekomendasi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
                </table>
        </div>
    </div>
</div>
@endsection