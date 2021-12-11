<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>Persentase Target</title>
    {{-- <style>
        .progress {
            width: 150px;
            height: 150px;
            background: none;
            position: relative;
            }

            .progress::after {
            content: "";
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 6px solid #eee;
            position: absolute;
            top: 0;
            left: 0;
            }

            .progress>span {
            width: 50%;
            height: 100%;
            overflow: hidden;
            position: absolute;
            top: 0;
            z-index: 1;
            }

            .progress .progress-left {
            left: 0;
            }

            .progress .progress-bar {
            width: 100%;
            height: 100%;
            background: none;
            border-width: 6px;
            border-style: solid;
            position: absolute;
            top: 0;
            }

            .progress .progress-left .progress-bar {
            left: 100%;
            border-top-right-radius: 80px;
            border-bottom-right-radius: 80px;
            border-left: 0;
            -webkit-transform-origin: center left;
            transform-origin: center left;
            }

            .progress .progress-right {
            right: 0;
            }

            .progress .progress-right .progress-bar {
            left: -100%;
            border-top-left-radius: 80px;
            border-bottom-left-radius: 80px;
            border-right: 0;
            -webkit-transform-origin: center right;
            transform-origin: center right;
            }

            .progress .progress-value {
            position: absolute;
            top: 0;
            left: 0;
            }

            /*
            *
            * ==========================================
            * FOR DEMO PURPOSE
            * ==========================================
            *
            */

            /* body {
            background: #ff7e5f;
            background: -webkit-linear-gradient(to right, #ff7e5f, #feb47b);
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            min-height: 100vh;
            } */

            .rounded-lg {
            border-radius: 1rem;
            }

            .text-gray {
            color: #aaa;
            }

            div.h4 {
            line-height: 1rem;
            }
    </style> --}}
  </head>
  <body>
    <div class="container">
        @foreach ($data as $row)
            <div class="row">
                <!-- For demo purpose -->
                <div class="col-lg-12 mx-auto mb-5 text-center">
                    <h4>Report Target {{ $nama }}</h4>
                </div>
                <!-- END -->
            </div>
            <table class="table">
                <tbody>
                    <tr>
                        <td style="width:25%;"><b>{{ $row->adv_name }}</b></td>
                        <td style="width:100%;"><b>Target:<span class="badge badge-primary">Rp {{ number_format($row->target) }}</span></b></td>
                        <td style="width:50%;"><b>Omset:<span class="badge badge-primary">{{ number_format($row->omset) }}</span></b></td>
                        <td style="width:25%;"><b>Date:<span class="badge badge-primary">{{ $row->start_date->format('F') }}</span></b></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            {{ number_format(($row->omset / $row->target) * 100, 2, ' ') }}<sup class="small">%</sup>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <table class="table table-bordered border-primary">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width:35%;">Nama CS</th>
                                        <th scope="col" style="width:15%;">Order</th>
                                        <th scope="col" style="width:75%;">Omset</th>
                                        <th scope="col" style="width:75%;">Target</th>
                                        <th scope="col" style="width:25%;">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($row->user->child as $items)
                                        <tr>
                                            <th>{{ $items->name }}</th>
                                            <td>{{ $cs->where('user_id', $items->id)->sum('qty') }}</td>
                                            <td>Rp {{ number_format($cs->where('user_id', $items->id)->sum('subtotal')) }}</td>
                                            <td>Rp {{ number_format($row->target / $row->user->child->count()) }}</td>
                                            <td><span class="badge badge-success">{{ number_format(($cs->where('user_id', $items->id)->sum('subtotal') / ($row->target / $row->user->child->count()) * 100) , 2, ',', ' ') }} %</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        @endforeach
    </div>

    <script>
        $(function() {

        $(".progress").each(function() {

        var value = $(this).attr('data-value');
        var left = $(this).find('.progress-left .progress-bar');
        var right = $(this).find('.progress-right .progress-bar');

        if (value > 0) {
            if (value <= 50) {
            right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
            } else {
            right.css('transform', 'rotate(180deg)')
            left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
            }
        }

        })

        function percentageToDegrees(percentage) {

        return percentage / 100 * 360

        }

        });

    </script>
  </body>
</html>
