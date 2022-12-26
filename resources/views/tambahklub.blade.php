@extends('layouts.index')

@section('content')
    @if (isset($error))
        {
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
        }
    @endif

    <h3 class="text-center mb-3">Tambah Data Klub</h3>
    <div class="d-flex justify-content-center">
        <form action="{{ url('/klub/store') }}" method="post" class="w-50">
            {{ csrf_field() }}
            <div class="mb-3">
                <label class="form-label">Nama Klub</label>
                <input type="text" class="form-control" id="klubName" name="nama" required>
            </div>
            @error('name')
                <span class="text-danger">{{ $message }}</span>
            @enderror

            <div class="mb-3">
                <label class="form-label">Kota Klub</label>
                <input type="text" class="form-control" id="klubPlace" name="kota" required>
            </div>

            <button type="submit" class="btn btn-dark w-100 mt-3">Simpan</button>
        </form>
    </div>
@endsection
