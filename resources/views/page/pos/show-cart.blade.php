@php
    $no = 1;
    $diskon =0;
@endphp
@foreach ($cart as $data)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $data->nama_produk }}</td>
        <td>{{ $data->jumlah }}</td>
        <td>{{ number_format($data->harga_jual) }}</td>
        <td>{{ number_format($data->diskon) }}</td>
        <td>{{ number_format($data->subtotal) }}</td>
        <td>
            <a href="" class="btn-sm btn-danger">x</a>
        </td>
    </tr>
@endforeach
