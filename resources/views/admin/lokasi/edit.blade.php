@extends('app')
@section('title', 'Edit Anggota')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="card-title">Update Location's Books</div>
</div>
<div class="card-body">
    {{-- buat debugging --}}
    <div>
        <ul style="background-color:red">
            @foreach ($errors->all() as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>
    {{-- akhir debugging --}}
    <form action="{{route ('lokasi.update', $location->id)}}" method="post">
        @csrf
        @method('PUT')
        <label for="" class="form-label">Kode Lokasi</label>
        <input type="text" class="form-control" name="kode_lokasi" value="{{ $location->kode_lokasi }}">

        <label for="" class="form-label">Label</label>
        <input type="text" class="form-control" name="label" value="{{ $location->label }}" >

        <label for="" class="form-label">Rak Buku</label>
        <input type="text" class="form-control" name="rak" value="{{ $location->rak }}">

        <button type="submit" class="btn btn-primary mt-2">Kirim</button>
    </form>
</div>
</div>


@endsection

