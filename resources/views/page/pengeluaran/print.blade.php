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
            <td style="width: 150px"> <img width="110px"
                    src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('template/img/bg.png'))) }}"
                    alt="" /></td>
            <td style="line-height: 10px">
                <h2>Rumah Makan</h2>
                <h1> CAHAYA PERKASA</h1>
                <p>Jl. By Pass, Kec Lubuk Begalung (+62) 8674534567 | rmcahayaperkasa@gmail.com</p>
                <h3>Laporan Pengeluaran</h3>
            </td>
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
            <th>Waktu Input</th>
            <th>Deskripsi</th>
            <th>Nominal</th>
        </tr>
        @php
            $no = 1;
            $total =0;
        @endphp
        @foreach ($pengeluaran as $data)
            {{ $total = $total+$data->nominal }}
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $data->created_at }}</td>
                <td>{{ $data->deskripsi }}</td>
                <td>Rp. {{ number_format($data->nominal, 2) }}</td>
            </tr>
        @endforeach
            <tr>
              <td colspan="3">Total Pengeluaran</td>
              <td>Rp. {{ number_format($total,2) }}</td>
            </tr>

    </table>
    <br><br><br>
    <table style="width: 100%" align="center">
        <tr>
            <td style="text-align: center">Dilaporan Oleh: <br><br><br><br>(................................)</td>
            <td style="text-align: center">Mengetahui Pimpinan: <br><br><br><br>(................................)</td>
        </tr>
    </table>

</body>

</html>
