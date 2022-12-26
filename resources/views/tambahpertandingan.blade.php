@extends('layouts.index')

@section('content')
    @if (isset($error))
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endif

    <form action="/pertandingan/store" method="post">
        {{ csrf_field() }}
        <button type="button" class="btn btn-outline-dark btn-sm mb-3">Tambah Form
            Pertandingan</button>
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label class="form-label">Klub 1</label>
                    <div class="d-flex gap-3">
                        <select class="form-select" aria-label="Default select example" id="matchKlub1" name="klub1"
                            required>
                            <option selected>Pilih Klub 1</option>
                            @foreach ($klubData as $klub)
                                <option value="{{ $klub->id }}">{{ $klub->nama }}</option>
                            @endforeach
                        </select>
                        <input type="text" class="form-control w-50" id="klubScore1" placeholder="Skor" name="skor1"
                            required>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label class="form-label">Pilih Klub 2</label>
                    <div class="d-flex gap-3">
                        <input type="text" class="form-control w-50" id="klubScore2" placeholder="Skor" name="skor2"
                            required>
                        <select class="form-select" aria-label="Default select example" id="matchKlub2" name="klub2"
                            required>
                            <option selected>Klub 2</option>
                            @foreach ($klubData as $klub)
                                <option value="{{ $klub->id }}">{{ $klub->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-dark w-100 mt-3">Simpan Skor Pertandingan</button>
    </form>
@endsection
