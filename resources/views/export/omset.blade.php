<table>
    <thead>
        <tr>
            <th colspan="2"><strong>Laporan Transaksi {{ $month }} - {{ $year }}</strong></th>
        </tr>
        <tr>
            <th colspan="2"></th>
        </tr>
        <tr>
            <th>Tanggal</th>
            <th>Omset</th>
            <th>Retur Order</th>
        </tr>
    </thead>
    <tbody>
        @foreach($omset as $row)
            <tr>
                <td>{{ $row['date'] }}</td>
                <td>Rp {{ number_format($row['total']) }}</td>
                <td>Rp {{ number_format($row['totalRetur']) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
