@extends('app')
@section('title', 'Data Role')
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Data Role</h3>
            <div align="right">

                <a href="{{ route('role.create') }}" class="btn btn-primary mt-2 mb-2">Tambah</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($roles as $item)
                        <tr>
                            <td>{{ $no++ }} </td>
                            <td>{{ $item->name }} </td>
                            <td>
                                <a href="{{ route('role.edit', $item->id) }}" class="btn btn-success">Edit</a>
                                <form action="{{ route('role.destroy', $item->id) }}" method="post" class="d-inline"
                                    onclick="return confirm('Yakin Ingin Menghapus?')">
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
