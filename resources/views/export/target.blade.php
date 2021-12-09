<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
    <table class="table table-hover table-light">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Target</th>
                <th>Omset</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->adv_name }}</td>
                    <td>{{ $item->omset }}</td>
                    <td>{{ $item->target }}</td>
                    <td>{{ $item->start_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
