@extends('app')
@section('title','Books')
@section('content')
 <div class="card">
    <div class="card-header">
        <div class="card-title">Manage Books</div>
    </div>
    <div class="card-body">
        <a href="{{url ('buku/create')}}" class="btn btn-primary mt-2 mb-2">Create</a>
        <div class="table table-responsive">
            <table class="table table-bordered text-center">
                <tr>
                    <th>No</th>
                    <th>Lokasi</th>
                    <th>Kategori</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun Penerbit</th>
                    <th>Actions</th>
                </tr>
                 @php
                        $no = 1;
                    @endphp
                 @foreach ($books as $item)
                <tr>
                    <td>{{ $no++}} </td>
                   <td>{{$item->lokasi->kode_lokasi . '-' . $item->lokasi->label . '-' . $item->lokasi->rak}}</td>
                   <td>{{$item->kategori->nama_kategori}}</td>

                    <td>{{$item->judul}} </td>
                    <td>{{$item->pengarang}} </td>
                    <td>{{$item->penerbit}} </td>
                    <td>{{$item->tahun_terbit}} </td>
                    <td>
                        <a href="" class="btn btn-success">Edit</a>
                        <form action="{{route('buku.destroy', $item->id)}}" method="post" style="display:inline" onclick="return confirm('Yakin Ingin Menghapus?')">
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
