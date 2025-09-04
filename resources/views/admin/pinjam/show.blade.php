@extends('app')
@section('title', 'Detail Peminjaman')
@section('content')
    <div class="row">
        <div align="right" class="col-sm-12 mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i>Kembali
            </a>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h3 class="card-title">Data Peminjam</h3>
                    <table class="table">
                        <tr>
                            <th>Nomor Transaksi</th>
                            <td>{{ $borrow->trans_number ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Pengembalian</th>
                            <td>{{ \Carbon\Carbon::parse($borrow->return_date)->format('d-M-Y') ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td>{{ $borrow->note ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h3 class="card-title">Data Anggota</h3>
                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <td>{{ $borrow->member->nama_anggota ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td>{{ $borrow->member->no_hp ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $borrow->member->email ?? '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Data Detail Peminjaman</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Penerbit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($borrow->detailBorrows as $index => $detailBorrow)
                                <tr>
                                    <td>{{ $index += 1 }}</td>
                                    <td>{{ $detailBorrow->book->judul }}</td>
                                    <td>{{ $detailBorrow->book->penerbit }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
