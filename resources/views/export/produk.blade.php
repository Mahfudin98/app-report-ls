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
            <th>Type</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order as $row)
            <tr>
                <td>{{ $row['labels'] }}</td>
                <td>{{ $row['total'] }}</td>
                <td>{{ $row['type'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
