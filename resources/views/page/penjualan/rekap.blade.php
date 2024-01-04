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
            <td style="line-height: 10px"><h2>Rumah Makan</h2><h1> YUANDA JAYA</h1> <p>Balai Makam, Kec. Mandau, Kabupaten Bengkalis, Riau 28983  (+62) 8674534567 | rmyuandajaya@gmail.com</p><h3>Rekap Data Penjualan <br><br><br> Tahun {{ $tahun }}</h3></td>
        </tr>
    </table>
    <hr style="border: 2px solid #222">
    <br>
    
    <table id="customers">
        <tr>
            <th>No</th>
            <th>Nama Menu</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
        @php
        $no=1;
        $total=0;
        @endphp
        @foreach ($detail as $data)
        @php
            $total = $total + $data->harga_jual * $data->all_jumlah;
        @endphp
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{  $data->nama_produk }}</td>
            <td>{{  $data->all_jumlah }}</td>
            <td>Rp. {{ number_format( $data->harga_jual )}}</td>
            <td>Rp. {{  number_format($data->harga_jual * $data->all_jumlah) }}</td>
           
        @endforeach
        <tr>
            <td colspan="4">Total Penjualan</td>
            <td>Rp. {{ number_format($total, 2) }}</td>
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
