<table>
    <thead>
        <tr>
            <th colspan="2"><strong>Data Customer {{ $date }}</strong></th>
        </tr>
        <tr>
            <th colspan="2"></th>
        </tr>
        <tr>
            <th>Nama Customer</th>
            <th>Alamat Customer</th>
            <th>Phone Customer</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($customer as $row)
            <tr>
                <td>{{ $row['customer_name'] }}</td>
                <td>{{ $row['customer_address'] }}</td>
                <td>{{ $row['customer_phone'] }}</td>
                <td>{{ $row['date'] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
