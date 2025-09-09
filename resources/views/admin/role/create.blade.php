@extends('app')
@section('title','Tambah Role')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Tambah Role</div>
</div>
<div class="card-body">

    <form action="{{route ('role.store')}}" method="post">
        @csrf
        <label for="" class="form-label">Nama *</label>
        <input type="text" class="form-control" name="name" required>

        <button type="submit" class="btn btn-primary mt-2">Simpan</button>
        <a href="{{url()->previous()}}" class="btn btn-success">Kembali</a>
    </form>
</div>
</div>


@endsection
