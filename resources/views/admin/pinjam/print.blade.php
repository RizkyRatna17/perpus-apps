<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk Pinjam Buku</title>
    <style>
        @page {
            size: 80mm auto;
            margin: 0
        }

        .text-center {
            text-align: center;
        }

        .small {
            font-size: 11px;
        }

        .text-bold {
            font-weight: bold;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .divider {
            border-top: 1px dashed black;
            margin: 10px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            /* border: 1px solid #222; */
            padding: 5px
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: black;
        }

        body {
            font-size: 12px;
            font-family: 'Courier New', Courier, monospace;
        }

        @media print {
            body {
                font-family: monospace;
                font-size: 12px;
                width: 80mm;
                margin: 0;
                padding: 8px;
            }
        }
    </style>
</head>

<body onload="window.print(); setTimeOut(() =>window.close(),500)">
    <h3 class="text-center">Perpustakaan PPKD Jakarta Pusat</h3>
    <div class="text-center small">Jl. Karet Baru Benhill Jakpus</div>

    <div class="divider"></div>

    <div class="small">
        <div class="row">
            <span>Kode Transaksi</span>
            <span class="text-bold">{{ $borrow->trans_number ?? '' }}</span>
        </div>
        <div class="row">
            <span>Tanggal Pinjam</span>
            <span class="text-bold">{{ \Carbon\Carbon::parse($borrow->created_at)->format('d m Y') }}</span>
        </div>
        <div class="row">
            <span>Tanggal Pengambalian</span>
            <span class="text-bold">{{ \Carbon\Carbon::parse($borrow->return_date)->format('d m Y') }}</span>
        </div>
        <div class="row">
            <span>Nama Peminjam</span>
            <span class="text-bold">{{ $borrow->member->nama_anggota ?? '' }}</span>
        </div>
    </div>
    <div class="divider"></div>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penerbit</th>
                <th></th>
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
    <div class="divider"></div>
    <div class="text-center small">Tunjukkan struk ini saat mengembalikan buku</div>

</body>

</html>
