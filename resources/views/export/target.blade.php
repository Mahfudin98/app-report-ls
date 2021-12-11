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
    <style>
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
    </style>
  </head>
  <body>
    <div class="container py-5">
        <div class="row">
            <!-- For demo purpose -->
            <div class="col-lg-12 mx-auto mb-5 text-center">
                <h1 class="display-4">Report Target</h1>
            </div>
            <!-- END -->
        </div>
        @foreach ($data as $row)
            <table class="table table-light">
                <tbody>
                    <tr>
                        <td><b>{{ $row->adv_name }}</b></td>
                        <td colspan="2"><b>Target:<span class="badge badge-primary">{{ $row->target }}</span></b></td>
                        <td><b>Omset:<span class="badge badge-primary">{{ $row->omset }}</span></b></td>
                        <td><b>Date:<span class="badge badge-primary">{{ $row->start_date }}</span></b></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="rounded-lg p-5 shadow">PERSENTASE</h2>

                                <!-- Progress bar 1 -->
                                <div class="progress mx-auto" data-value='10'>
                                    <span class="progress-left">
                                        <span class="progress-bar border-primary"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar border-primary"></span>
                                    </span>
                                    <div class="progress-value w-100 h-100 rounded-circle d-flex align-items-center justify-content-center">
                                    <div class="h2 font-weight-bold">{{ number_format(($row->omset / $row->target) * 100, 2, ' ') }}<sup class="small">%</sup></div>
                                    </div>
                                </div>
                                <!-- END -->
                            </div>
                        </td>
                        <td colspan="3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Nama CS</th>
                                        <th scope="col">Order</th>
                                        <th scope="col">Omset</th>
                                        <th scope="col">Target</th>
                                        <th scope="col">Persentase</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($row->user->child as $items)
                                        <tr>
                                            <th>{{ $items->name }}</th>
                                            <td>{{ $cs->where('user_id', $items->id)->sum('qty') }}</td>
                                            <td>{{ $cs->where('user_id', $items->id)->sum('subtotal') }}</td>
                                            <td>{{ $row->target / $row->user->child->count() }}</td>
                                            <td>{{ number_format(($cs->where('user_id', $items->id)->sum('subtotal') / ($row->target / $row->user->child->count()) * 100) , 2, ',', ' ') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 mx-auto mb-5 text-center">
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 mb-3">
                                    <h5></h5>
                                </div>
                                <div class="col-xl-3 col-lg-6 mb-3">
                                    <h5></h5>
                                </div>
                                <div class="col-xl-3 col-lg-6 mb-3">
                                    <h5></h5>
                                </div>
                                <div class="col-xl-3 col-lg-6 mb-3">
                                    <h5></h5>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="col-xl-3 col-lg-6 mb-4">

                        </div>
                        <div class="col mb-8">
                            <div class="card">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
