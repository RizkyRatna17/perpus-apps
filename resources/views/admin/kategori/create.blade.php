@extends('app')
@section('title','Location of Books')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Create Category of Books</div>
</div>
<div class="card-body">

    <form action="{{route ('kategori.store')}}" method="post">
        @csrf
        <label for="" class="form-label">Nama Kategori</label>
        <input type="text" class="form-control" name="nama_kategori">

        <button type="submit" class="btn btn-primary mt-2">Kirim</button>
    </form>
</div>
</div>


@endsection
