@extends('app')
@section('title','Location of Books')
@section('content')
 <div class="card">
    <div class="card-header">
        <div class="card-title">Manages Of Books Categories</div>
    </div>
    <div class="card-body">
        <a href="{{url ('kategori/create')}}" class="btn btn-primary mt-2 mb-2">Create</a>
        <div class="table table-responsive">
            <table class="table table-bordered text-center">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Action</th>
                </tr>
                 @php
                        $no = 1;
                    @endphp
                 @foreach ($categories as $item)
                <tr>
                    <td>{{ $no++}} </td>
                    <td>{{$item->nama_kategori}} </td>
                    <td>
                        <a href="{{route('kategori.edit',$item->id)}}" class="btn btn-success">Edit</a>
                        <form action="{{route('kategori.destroy', $item->id)}}" method="post" style="display:inline" onclick="return confirm('Yakin Ingin Menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
 </div>
@endsection
