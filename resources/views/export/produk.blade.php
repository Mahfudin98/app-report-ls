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
        </tr>
    </thead>
    <tbody>
        @foreach($order as $row)
            <tr>
                <td>{{ $row['labels'] }}</td>
                <td>{{ $row['total'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
