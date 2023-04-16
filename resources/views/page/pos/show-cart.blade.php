@php
    $no = 1;
@endphp
@foreach ($cart as $data)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $data->nama_produk }}</td>
        <td>{{ $data->jumlah }}</td>
        <td>{{ number_format($data->harga_jual) }}</td>
        <td>-{{ number_format($data->sub_total_diskon) }}</td>
        <td>{{ number_format($data->subtotal) }}</td>
        <td>
            <a onclick="kurangCart({{ $data->id_penjualan_detail }})" class="btn-sm btn-warning"><i class="fa fa-minus"></i></a>
            <a onclick="hapusCart({{ $data->id_penjualan_detail }})" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
@endforeach
