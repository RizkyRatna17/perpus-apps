@extends('app')
@section('title', 'Data Peminjaman Buku')
@section('content')

  <div class="card">
    <div class="card-body">
        <h3 class="card-title">{{$title ?? ''}}</h3>
        <div align='right' class="mb-3">
            <a href="{{route('transaction.create')}}" class="btn btn-primary">Tambah</a>

        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Peminjaman</th>
                        <th>Anggota</th>
                        <th>Tanggal Kembali</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <a href="" class="btn btn-success btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
  </div>



@endsection

