<table>
    <thead>
        <tr>
            <th colspan="2"><strong>Laporan Transaksi {{ $month }} - {{ $year }}</strong></th>
        </tr>
        <tr>
            <th colspan="2"></th>
        </tr>
        <tr>
            <th>Produk</th>
            <th>Total</th>
            <th>Tipe</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order as $row)
            <tr>
                <td>{{ $row['product']['name'] }}</td>
                <td>{{ $row['sum'] }}</td>
                <td>{{ $row['product']['type_pembelian_label'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
