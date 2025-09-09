@extends('app')
@section('title', 'Data User')
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">Data User</h3>
            <div align="right">

                <a href="{{ route('user.create') }}" class="btn btn-primary mt-2 mb-2">Tambah</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($users as $item)
                        <tr>
                            <td>{{ $no++ }} </td>
                            <td>{{ $item->name }} </td>
                            <td>{{ $item->email }} </td>

                            <td>
                                @foreach ($item->roles as $role)
                                    <span class="badge text-bg-primary">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ route('user.roles', $item->id) }}" class="btn btn-warning">Tambah Role</a>
                                <a href="{{ route('user.edit', $item->id) }}" class="btn btn-success">Edit</a>
                                <form action="{{ route('user.destroy', $item->id) }}" method="post" class="d-inline"
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
