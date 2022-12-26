@extends('layouts.index')

@section('content')

    <h1 class="text-center">Pertandingan Bola</h1>
    <a href="/pertandingan/create" type="button" class="btn btn-dark my-3">
        Tambah Pertandingan
    </a>
    <table class="table table-bordered table-responsive">
        <tr>
            <th>No.</th>
            <th>Klub</th>
            <th>Ma</th>
            <th>Me</th>
            <th>S</th>
            <th>K</th>
            <th>GM</th>
            <th>GK</th>
        </tr>
        @if (count($pertandinganData) === 0)
            <td colspan="8" class="text-center">Data kosong</td>
        @else
            @foreach ($pertandinganData as $pertandingan)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $pertandingan->klub->nama }}</td>
                    <td>{{ $pertandingan->totalMatch }}</td>
                    <td>{{ $pertandingan->total_menang }}</td>
                    <td>{{ $pertandingan->total_seri }}</td>
                    <td>{{ $pertandingan->total_kalah }}</td>
                    <td>{{ $pertandingan->total_gol }}</td>
                    <td>{{ $pertandingan->total_bobol }}</td>
                </tr>
            @endforeach
        @endif
    </table>

    <a href="/klub/create" type="button" class="btn btn-dark my-3">
        Tambah Klub
    </a>
    <table class="table table-bordered table-responsive">
        <tr>
            <th>No.</th>
            <th>Klub</th>
            <th>Kota</th>
        </tr>
        @if (count($klubData) === 0)
            <td colspan="3" class="text-center">Data kosong</td>
        @else
            @foreach ($klubData as $klub)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $klub->nama }}</td>
                    <td>{{ $klub->kota }}</td>
                </tr>
            @endforeach
        @endif
    </table>

@endsection
