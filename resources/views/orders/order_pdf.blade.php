<!DOCTYPE html>
<html>

<head>
    <title>{{ __('models/orders.singular') . '#' . $order->id }}</title>
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
        <table style="border:none">
            <thead>
                <tr style="border:none">

                    <!-- Address Field -->
                    <td style="border:none">
                        <h1>{{ __('models/addresses.fields.address') . ':  ' }}</h1>
                        <span>{{ $order ? $order->address : '' }}</span>
                    </td>

                </tr>

                <tr style="border:none">
                    <td style="border:none">
                        <h1>{{ __('models/orders.fields.total_price') . ':  ' }}</h1>
                        <span>{{ $order->total_price }}</span>
                    </td>

                    <td style="border:none">
                        <h1>{{ __('models/orders.fields.tax') . ':  ' }}</h1>
                        <span>{{ $order->tax }}</span>
                    </td>
                </tr>
                <tr style="border:none">
                    <td style="border:none">
                        <h1>{{ __('models/coupons.singular') . ':  ' }}</h1>
                        <span>{{ $order->coupon?->code ?? '' }}</span>
                    </td>
                    <td style="border:none">
                        <h1>{{ __('awt.coupon_discount') . ':  ' }}</h1>
                        <span>{{ $order->coupon ? ($order->coupon->is_ratio ? $order->total_price * $order->coupon->value : $order->coupon->value) : '' }}</span>
                    </td>

                </tr>
                <tr style="border:none">
                    <td style="border:none">
                        <h1>{{ __('models/orders.fields.final_price') . ':  ' }}</h1>
                        <span>{{ $order->final_price }}</span>
                    </td>
                </tr>
            </thead>
        </table>
        <div class="table-responsive-sm">

            <table class="table pt-5" id="student-table">
                <thead>

                    <tr style="background-color: rgb(235, 236, 240)">
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">{{ __('awt.Image') }}</th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">
                            {{ __('models/products.singular') }}</th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">
                            {{ __('models/optionKeys.singular') }}</th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">
                            {{ __('models/products.fields.price') }}</th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">
                            {{ __('awt.Purchase Price') }}</th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">
                            {{ __('models/products.fields.quantity') }}</th>
                        <th style="width: 150px; text-align:center;background-color:#D7DBDF">
                            {{ __('models/orders.fields.final_price') }}</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->products as $ob)
                        <tr>
                            <td style="text-align: center"><img
                                    src="{{ dashboard_url($ob->image_path)  }}" width="70"
                                    style=" border-radius: 1000%;"></td>
                            <td style="text-align: center">{{ $ob->name }}</td>
                            <td style="text-align: center">
                                {{ $ob->pivot->product_option_key_id ? App\Models\ProductOptionKey::where('id', $ob->pivot->product_option_key_id)->first()->optionkey['key'] : '' }}

                            </td>
                            <td style="text-align: center">{{ $ob->pivot->price }}</td>
                            <td style="text-align: center">{{ $ob->pivot->purchase_price }}</td>
                            <td style="text-align: center">{{ $ob->pivot->quantity }}</td>
                            <td style="text-align: center">{{ $ob->pivot->purchase_price * $ob->pivot->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <style>
        td {
            text-align: start;
        }
    </style>
</body>

</html>
