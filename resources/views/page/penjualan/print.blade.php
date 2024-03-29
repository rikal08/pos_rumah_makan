<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>

    <table style="width:100%" align="left">


        <tr>
            <td style="width: 170px"> <img width="160px" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('template/img/bg2.jpeg'))) }}" alt="" /></td>
            <td style="line-height: 10px"><h2>Rumah Makan</h2><h1> YUANDA JAYA</h1> <p>Balai Makam, Kec. Mandau, Kabupaten Bengkalis, Riau 28983  (+62) 8674534567 | rmyuandajaya@gmail.com</p><h3>Laporan Data Penjualan</h3></td>
        </tr>
    </table>
    <hr style="border: 2px solid #222">
    <br>
    <span style="background-color: #bbb;padding: 10px; width:100%;color:#fff;text-align:center;">Waktu Laporan:
        {{ $tgl_awal }} / {{ $tgl_akhir }}</span>
    <br><br><br>
    <table id="customers">
        <tr>
            <th>No</th>
            <th>Waktu Transaksi</th>
            <th>No Transaksi</th>
            <th>Nama Pelanggan</th>
            <th>Pembelian</th>
            <th>Total Item</th>
            <th>Total Harga</th>
            <th>Bayar</th>
            <th>Kembali</th>
            <th>Nama Kasir</th>
        </tr>
        @php
        $no=1;
        $total=0;
        @endphp
        @foreach ($penjualan as $data)
        {{ $total= $total + $data->total_harga; }}
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $data->created_at }}</td>
            <td>{{ $data->no_transaksi }}</td>
            <td>
                @if ($data->id_pelanggan==0)
                    Tidak ada nama pelanggan
                @else
                    {{ $data->nama_pelanggan }}
                @endif
            </td>
            <td>
                @foreach ($detail as $item)
                    @if ($data->no_transaksi==$item->no_transaksi)
                        <p>- ({{ $item->jumlah }}) * {{ $item->nama_produk }}</p>
                    @else
                        
                    @endif
                @endforeach
            </td>
            <td>{{ $data->total_item }}</td>
            <td>Rp. {{ number_format($data->total_harga) }}</td>
            <td>Rp. {{ number_format($data->bayar) }}</td>
            <td>Rp. {{ number_format($data->kembali) }}</td>
            <td>{{  $data->name }}</td>
        @endforeach
        <tr>
            <td colspan="6">Total Penjualan</td>
            <td colspan="5">Rp. {{ number_format($total, 2) }}</td>
        </tr>

    </table>
    <br><br><br>
    <table style="width: 100%" align="center">
        <tr>
            <td style="text-align: center">Dilaporan Oleh: <br><br><br><br>({{ Auth::user()->name }})</td>
            <td style="text-align: center">{{ date('d-m-Y') }}<br>Mengetahui Pimpinan: <br><br><br><br>(Yuanda)</td>
        </tr>
        
    </table>

</body>

</html>
