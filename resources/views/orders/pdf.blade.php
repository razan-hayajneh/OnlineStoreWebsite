<!DOCTYPE html>
<html>

<head>
    <title>{{ __('models/orders.plural') }}</title>
</head>
<style>
    table,
    td,
    th,
    tr,
    td {
        border: 1px solid rgb(3, 3, 3);
        text-align: center;
        font-size: smaller;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        padding: 15px;
    }

    h1,
    img {
        font-size: medium;
        text-align: center;

    }

    .img-contanier {
        text-align: center;
    }

    .test {
        max-width: 20px;
        height: auto;
    }
</style>

<body>

    <div class="table-responsive">


        <div class="table-responsive-sm">

            <table class="table pt-5" id="student-table">
                <thead>
                    <tr>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">{{ __('awt.name') }}
                        </th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">{{ __('awt.Order Status') }}
                        </th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">{{ __('awt.total_price') }}
                        </th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">
                            {{ __('awt.coupon_discount') }}
                        </th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">{{ __('awt.tax') }}
                        </th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">{{ __('awt.final_price') }}
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $ob)
                        <tr>

                            <td style="text-align: center">{{ $ob->user?->name }}</td>
                            <td style="text-align: center">{{ $ob->order_status }}</td>
                            <td style="text-align: center">{{ $ob->total_price }}</td>
                            <td style="text-align: center">
                                {{ $ob->coupon?->is_ratio ? $ob->total_price * $ob->coupon?->value : $ob->coupon?->value }}
                            </td>
                            <td style="text-align: center">{{ $ob->tax }}</td>
                            <td style="text-align: center">{{ $ob->final_price }}</td>

                        </tr>
                    @endforeach

                </tbody>




            </table>


        </div>
    </div>
</body>

</html>
