@extends('app')
@section('title', 'Edit Role')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="card-title">Edit Role</div>
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
    <form action="{{route('role.update',$edit->id)}}" method="post">
        @csrf
        @method('PUT')
        <label for="" class="form-label">Nama</label>
        <input type="text" class="form-control" name="name" value="{{ $edit->name }}">


        <button type="submit" class="btn btn-primary mt-2">Simpan</button>
        <a href="{{url()->previous()}}" class="btn btn-success">Kembali</a>

    </form>
</div>
</div>


@endsection

