@extends('app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Create Anggota</div>
        </div>
        <div>
            @foreach ($errors->all() as $i)
                <ul style="background-color: red ">
                    <li>{{ $i }}</li>
                </ul>
            @endforeach
        </div>
        <div class="card-body">
            <form action="{{ route('anggota.store') }}" method="post">
                @csrf
                <label for="" class="form-label">No Anggota</label>
                <input type="text" class="form-control" name="nomor_anggota" value="{{ $code }}" readonly>

                <label for="" class="form-label">Nik</label>
                <input type="number" class="form-control" name="nik" value="{{ old('nik') }}">

                <label for="">Nama Anggota</label>
                <input type="text" class="form-control" name="nama_anggota" value="{{ old('nama_anggota') }}">

                <label for="" class="form-label">No Hp</label>
                <input type="tel" class="form-control" value="{{ old('no_hp') }}" name="no_hp">

                <label for="" class="form-label">Email</label>
                <input type="email" class="form-control" value="{{ old('email') }}" name="email">

                <button type="submit" class="btn btn-primary mt-2">Kirim</button>
            </form>
        </div>
    </div>
@endsection
