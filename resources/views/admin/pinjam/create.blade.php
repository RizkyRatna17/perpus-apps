@extends('app')
@section('title', 'Tambah Peminjaman Buku')
@section('content')
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $title ?? '' }}</h3>

            <form action="" method="POST">
                @csrf
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="" class="form-label">No Transaksi</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="trans_number" value="{{ $trans_number }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="" class="form-label">Anggota</label>
                            </div>
                            <div class="col-sm-7">
                                <select name="id_anggota" id="id_anggota" class="form-control">
                                    <option value="">Pilih Anggota</option>
                                    @foreach ($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->nama_anggota }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="" class="form-label">Kategori Buku</label>
                            </div>
                            <div class="col-sm-7">
                                <select name="" id="id_kategori" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}
                                    @endforeach
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-sm-3">
                                <label for="" class="form-label">Buku</label>
                            </div>
                            <div class="col-sm-7">
                                <select name="" id="id_buku" class="form-control">
                                    <option value="">Pilih Buku</option>

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 mt-5">
                        <div align="right" class="mb-3">
                            <button type="button" id="addRow" class="btn btn-primary">Tambah Row</button>
                        </div>
                        <table class="table table-bordered" id="tableTrans">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th></th>
                                </tr>

                            </thead>
                            <tbody></tbody>

                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
