@extends('app')
@section('content', 'Manage Anggota')
@section('title')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Manage Anggota</div>
        </div>
        <div class="card-body">
            <div class="table table-responsive">
                <a href="{{ url('anggota/create') }}" class="btn btn-primary mt-2 mb-2">Create</a>
                <a href="{{ url('anggota/restore') }}" class="btn btn-warning mt-2 mb-2">Restore</a>
                <table class="table table-bordered text-center">
                    <tr>
                        <th>No</th>
                        <th>No Anggota</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($members as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nomor_anggota }}</td>
                            <td>{{ $item->nama_anggota }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a href="{{ route('anggota.edit', $item->id) }}" class="btn btn-success">Edit</a>
                                <form action="{{ route('anggota.softdelete', $item->id) }}" method="post"
                                    style="display: inline" onclick="return confirm('Ingin delete ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
