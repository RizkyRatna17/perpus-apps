@extends('app')
@section('title','Create Books')
@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Create Books</div>
</div>
<div class="card-body">
    <form action="{{route('buku.store')}}" method="post">
        @csrf
        <label for="" class="form-label"> Lokasi</label>
        <select name="id_lokasi"  class="form-select">
              <option value="">--Pilih Lokasi--</option>
               @foreach ($locations as $item)
                <option value="{{$item->id}}">{{$item->kode_lokasi . '-' . $item->label . '-' . $item->rak}}</option>
                
            @endforeach

        </select>

        <label for="" class="form-label">Kategori</label>
        <select name="id_kategori"  class="form-select" >
            <option value="">--Pilih Kategori--</option>
            @foreach ($categories as $item)
                <option value="{{$item->id}}">{{$item->nama_kategori}}</option>
            @endforeach
        </select>

        <label for="" class="form-label">Judul Buku</label>
        <input type="text" class="form-control" name="judul">

         <label for="" class="form-label">Pengarang</label>
        <input type="text" class="form-control" name="pengarang">

         <label for="" class="form-label">Penerbit</label>
        <input type="text" class="form-control" name="penerbit">

         <label for="" class="form-label">Tahun Penerbit</label>
        <input type="date" class="form-control" name="tahun_terbit">

         <label for="" class="form-label">Keterangan</label>
        <textarea name="keterangan" cols="30" rows="5" class="form-control"></textarea>

         <label for="" class="form-label">Stock Buku</label>
        <input type="number" min="1" max="1000" class="form-control" name="stok">

        <button type="submit" class="btn btn-primary mt-2">Kirim</button>
    </form>
</div>
</div>


@endsection
