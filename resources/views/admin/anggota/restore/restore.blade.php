@extends('app')
@section('content', 'Manage Anggota')
@section('title')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Restore Anggota</div>
        </div>
        <div class="card-body">
            <div class="table table-responsive">
                <a href="{{ url('anggota/index') }}" class="btn btn-secondary mt-2 mb-2">Back</a>
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
                    @foreach ($member_r as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nomor_anggota }}</td>
                            <td>{{ $item->nama_anggota }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a href="{{ route('anggota.restore', $item->id) }}" class="btn btn-warning">Restore</a>
                                <form action="{{ route('anggota.destroy', $item->id) }}" method="post"
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
