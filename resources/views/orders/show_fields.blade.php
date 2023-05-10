<!-- User Id Field -->
<div class="col-sm-3">
    {{-- {!! Form::label('user_id', __('models/orders.fields.user_id') . ':') !!} --}}
    <div>
        <img src="{{ dashboard_url($order->user?->profile_path_path) }}" width="200" style="border-radius: 1000px;">
        <div class="inline"><i class="nav-icon fa fa-user m-2"></i><span>{{ $order->user?->name }}</span></div>
        <div class="inline-flex"><i class="nav-icon fa fa-envelope m-2"></i><span></span>{{ $order->user?->email }}</span>
        </div>
        <div class="inline-flex"><span class="text-bold m-2">{{ __('awt.status') }}:</span><span
                class="m-2">{{ $order->order_status }}</span>
            <button onclick="getOrderStatuses()" data-toggle="modal" data-target="#editStutus" class="group"
                style="border: none;background-color: #FFFFFF;color:#007BFF">
                <i class="fa fa-edit"></i>
            </button>
        </div>
        <!-- Created At Field -->
        <div class="inline-flex m-2">
            {!! Form::label('created_at', __('awt.created_date') . ':') !!}
            <p>{{ $order->created_at }}</p>
        </div>
    </div>
</div>

<div class="col-lg-9">
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-condensed" style="border-collapse:collapse;">
                <tbody>
                    <tr data-toggle="collapse" data-target="#demo2" class="accordion-toggle border">
                        <td><button class="btn btn-default btn-xs"><span
                                    class="glyphicon glyphicon-eye-open"></span></button></td>
                        <td>{{ __('models/clients.fields.details') }}</td>
                    </tr>
                    <tr class="hiddenRow">
                        <td colspan="12">
                            <div id="demo2" class="accordian-body collapse">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>
                                                {!! Form::label('address', __('models/clients.fields.address') . ':') !!}
                                                <p>{{ $order ? $order->address: '' }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {!! Form::label('notes', __('models/clients.fields.notes') . ':') !!}
                                                <p>{{ $order ? $order->notes: '' }}</p>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle border">
                        <td><button class="btn btn-default btn-xs"><span
                                    class="glyphicon glyphicon-eye-open"></span></button></td>
                        <td>{{ __('awt.order_detail') }}</td>
                    </tr>
                    <tr>
                        <td colspan="12">
                            <div>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>{!! Form::label('total_price', __('models/orders.fields.total_price') . ':') !!}
                                                <p>{{ $order->total_price }}</p>
                                            </td>
                                            <td>{!! Form::label('tax', __('models/orders.fields.tax') . ':') !!}
                                                <p>{{ $order->tax }}</p>
                                            </td>
                                        </tr>
                                        @if ($order->coupon)
                                            <tr>

                                                <td>
                                                    <!-- Coupoun code Field -->
                                                    {!! Form::label('coupoun_code', __('models/coupons.singular') . ':') !!}
                                                    <p>{{ $order->coupon?->code ?? '' }}</p>
                                                </td>
                                                <td>
                                                    <!-- Coupoun value Field -->
                                                    {!! Form::label('coupoun_value', __('awt.coupon_discount') . ':') !!}
                                                    <p>{{ $order->coupon ? ($order->coupon->is_ratio ? $order->total_price * $order->coupon->value : $order->coupon->value) : '' }}
                                                    </p>

                                                </td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>{!! Form::label('final_price', __('models/orders.fields.final_price') . ':') !!}
                                                <p>{{ $order->final_price }}</p>
                                            </td>
                                        </tr>
                                    </thead>
                                </table>

                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <table class="table">
        <thead>

            <tr style="background-color: rgb(235, 236, 240)">
                <th scope="col">{{ __('awt.Image') }}</th>
                <th scope="col">{{ __('models/products.singular') }}</th>
                <th scope="col">{{ __('models/optionKeys.singular') }}</th>
                <th scope="col">{{ __('models/products.fields.price') }}</th>
                <th scope="col">{{ __('awt.Purchase Price') }}</th>
                <th scope="col">{{ __('models/products.fields.quantity') }}</th>
                <th scope="col">{{ __('models/orders.fields.final_price') }}</th>
                <th scope="col">{{ __('awt.Actions') }}</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($order->products as $ob)
                <tr>
                    <td class="border">
                            <img src="{{ dashboard_url($ob->product?->image_path) }}"
                                height="60" width="60" style=" border-radius: 1000%;">
                    </td>
                    <td class="border">{{ $ob->product?->name }}</td>
                    <td class="border">
                        {{ $ob->optionKey->key }}

                    </td>
                    {{-- $ob->pivot->product_option_key_id --}}
                    <td class="border">{{ $ob->pivot->price }}</td>
                    <td class="border">{{ $ob->pivot->purchase_price }}</td>
                    <td class="border">

                        <input type="number" readonly
                            onchange="editQuantity({{ $order->id }},{{ $ob->pivot->id }})"
                            value="{{ $ob->pivot->quantity }}" id="quantity[{{ $ob->pivot->id }}]"
                            name="quantity[{{ $ob->pivot->id }}]" min="1"
                            max="{{ $ob->pivot->quantity + $ob->quantity }}">
                        <a href=""><i id="quantitySubmit[{{ $ob->pivot->id }}]" style="display: none"
                                class="fa fa-check"></i> </a>
                        <i onclick="editQuantityInput({{ $order->id }},{{ $ob->pivot->id }})"
                            id="quantityEdit[{{ $ob->pivot->id }}]" class="fa fa-edit"></i>
                    </td>
                    <td class="border">{{ $ob->pivot->purchase_price * $ob->pivot->quantity }}</td>
                    <td class="border">
                        {!! Form::open([
                            'route' => ['order.destroyProduct', ['id' => $ob->pivot->id, 'order_id' => $order->id]],
                            'method' => 'post',
                        ]) !!}
                        <div class='btn-group'>
                            {!! Form::button('<i class="fa fa-trash"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger btn-xs',
                                'onclick' => 'return confirm("' . __('crud.are_you_sure') . '")',
                            ]) !!}
                        </div>
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
</div>
{{-- <form method="post" action="{{ route('order.addProduct') }}"> --}}
<!-- Modal Example Start-->
{!! Form::open(['route' => 'order.addProduct']) !!}
<div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="demoModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="demoModalLabel">{{ __('awt.Add New Product To order #') . $order->id }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::number('order_id', isset($order) ? $order->id : null, ['class' => 'form-control hidden']) !!}

                <div>
                    <!-- Parent Id Field -->
                    <div class="form-group col-sm-5" style="display: inline-block;">
                        {!! Form::label('main_category_id', __('awt.Main Category') . ':') !!}
                        {!! Form::select('main_category_id', isset($main_categories) ? $main_categories : [], null, [
                            'class' => 'form-control custom-select',
                            'id' => 'main_category_id',
                            'onchange' => 'getSubCategory()',
                        ]) !!}
                    </div>
                    <!-- Parent Id Field -->
                    <div class="form-group col-sm-5" style="display: inline-block;">
                        {!! Form::label('sub_category_id', __('awt.Category') . ':') !!}
                        {!! Form::select('sub_category_id', isset($sub_categories) ? $sub_categories : [], null, [
                            'class' => 'form-control custom-select',
                            'id' => 'sub_category_id',
                            'onchange' => 'getProducts()',
                        ]) !!}
                    </div>

                </div>
                <div>
                    <!-- Parent Id Field -->
                    <div class="form-group col-sm-5" style="display: inline-block;">
                        {!! Form::label('product_id', __('awt.Product') . ':') !!}
                        {!! Form::select('product_id', isset($products) ? $products : [], null, [
                            'class' => 'form-control custom-select',
                            'id' => 'product_id',
                            'onchange' => 'getOptions()',
                        ]) !!}
                    </div>
                    <!-- Parent Id Field -->
                    <div class="form-group col-sm-5" style="display: inline-block;">
                        {!! Form::label('option_id', __('awt.Option') . ':') !!}
                        {!! Form::select('option_id', isset($options) ? $options : [], null, [
                            'class' => 'form-control custom-select',
                            'id' => 'option_id',
                            'onchange' => 'getOptionData()',
                        ]) !!}
                    </div>

                </div>
                <div>
                    <!-- Quantity Field -->
                    <div class="form-group col-sm-5" style="display: inline-block;">
                        {!! Form::label('price', __('awt.Price') . ':') !!}
                        {!! Form::number('price', null, [
                            'class' => 'form-control',
                            'id' => 'price',
                            'min' => 0,
                            'step' => '0.01',
                            'readonly',
                        ]) !!}
                    </div>
                    <!-- Quantity Field -->
                    <div class="form-group col-sm-5" style="display: inline-block;">
                        {!! Form::label('purchase_price', __('awt.Purchase Price') . ':') !!}
                        {!! Form::number('purchase_price', null, [
                            'class' => 'form-control',
                            'id' => 'purchase_price',
                            'onchange' => 'totalPrice()',
                            'min' => 0,
                            'step' => '0.01',
                        ]) !!}
                    </div>

                </div>
                <div>
                    <!-- Quantity Field -->
                    <div class="form-group col-sm-5" style="display: inline-block;">
                        {!! Form::label('quantity', __('awt.Quantity') . ':') !!}
                        {!! Form::number('quantity', null, [
                            'class' => 'form-control',
                            'id' => 'quantity',
                            'onchange' => 'totalPrice()',
                            'min' => 0,
                        ]) !!}
                    </div>
                    <!-- Quantity Field -->
                    <div class="form-group col-sm-5" style="display: inline-block;">
                        {!! Form::label('total_price', __('awt.total_price') . ':') !!}
                        {!! Form::number('total_price', null, [
                            'class' => 'form-control',
                            'id' => 'total_price',
                            'step' => '0.01',
                            'readonly',
                        ]) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        aria-label="Close">{{ __('awt.Close') }}</button>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Example End-->
    </table>
    <br>
    {!! Form::close() !!}
</div>

<!-- Modal Example Start-->
{!! Form::open(['route' => 'order.editStatus']) !!}
<div class="modal fade" id="editStutus" tabindex="-1" role="dialog" aria-labelledby="editStutusLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStutusLabel">{{ __('Edit status order #') . $order->id }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::number('order_id', isset($order) ? $order->id : null, ['class' => 'form-control hidden']) !!}

                <!-- Parent Id Field -->
                <div class="form-group col-sm-5" style="display: inline-block;">
                    {!! Form::label('order_status', __('awt.order_status') . ':') !!}
                    {!! Form::select(
                        'order_status',
                        isset($order_statuses) ? $order_statuses : [],
                        isset($order) ? $order->order_status : null,
                        [
                            'class' => 'form-control custom-select',
                            'id' => 'order_status',
                            'data-placeholder' => '--Select--'
                        ],
                    ) !!}
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    aria-label="Close">{{ __('awt.Close') }}</button>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
</div>
<!-- Modal Example End-->
</table>
<br>
{!! Form::close() !!}
</div>

<style>
    .table td {
        border-top: 0px solid #dee2e6;
    }

    .hidden {
        display: none;
    }

    input[type=number] {
        border: none;
        border-bottom: 2px solid rgb(163, 149, 149);
        width: 90%
    }

    .modal-dialog {
        max-width: 60%;
        display: block;
    }
</style>
<script>
    $("#purchase_price").change(function() {
        var quantity = document.getElementById("quantity").value;
        var purchase_price = document.getElementById("purchase_price").value;
        document.getElementById("total_price").value = quantity * purchase_price;
    });
    $("#quantity").change(function() {
        var quantity = document.getElementById("quantity").value;
        var purchase_price = document.getElementById("purchase_price").value;
        document.getElementById("total_price").value = quantity * purchase_price;
    });
    function editQuantity(order_id, id) {
        var quantity = document.getElementById("quantity[" + id + "]").value;
        // alert(quantity);
        $.ajax({

            type: 'get',
            url: `{{ route('orderProduct.editQuantity') }}`,
            datatype: 'json',
            data: {
                'id': id,
                'order_id': order_id,
                'quantity': quantity
            },
            success: function(res) {
                document.getElementById("quantity[" + id + "]").value;
            }
        });
    }

    function editQuantityInput(order_id, id) {
        document.getElementById("quantity[" + id + "]").removeAttribute('readonly');
        document.getElementById("quantityEdit[" + id + "]").style.display = "none";
        document.getElementById("quantitySubmit[" + id + "]").style.display = "block";
        var quantity = document.getElementById("quantity[" + id + "]").value;
        var a = document.getElementById("quantitySubmit[" + id + "]")
        a.href = route('orderProduct.editQuantity', {
            'id': id,
            'order_id': order_id,
            'quantity': quantity
        });
    }

    function getOrderStatuses() {
        var html = '';
        // var sub_category_id = '';
        var order_status = {{!! $order->order_status !!}};
        // alter(order_status_id);
        $('#order_status').empty();
        $.ajax({
            url: `{{ route('admin.ajax.getOrderStatuses') }}`,
            type: 'get',
            dataType: 'json',
            data: {},
            success: function(res) {
                html +=
                    `<option value="" hidden selected>{{ app()->getLocale() == 'ar' ? '--اختر--' : '--select--' }}</option>`;
                $.each(res.data, function(index, value) {
                    html +=
                        `<option value="${index}" ${order_status == index ? 'selected':'' }>${value}</option>`;
                });
                $('#order_status').append(html);
            }
        });
    }

    function getCategories() {
        // var main_category_id = document.getElementById("main_category_id").value;
        var html = '';
        var sub_category_id = '';
        $('#main_category_id').empty();
        $.ajax({
            url: `{{ route('admin.ajax.getCategories') }}`,
            type: 'get',
            dataType: 'json',
            data: {},
            success: function(res) {
                html +=
                    `<option value="" hidden selected>{{ app()->getLocale() == 'ar' ? '--اختر--' : '--select--' }}</option>`;
                $.each(res.data, function(index, value) {
                    html +=
                        `<option value="${index}" ${main_category_id == index ? 'selected':'' }>${value}</option>`;
                });
                $('#main_category_id').append(html);
            }
        });
    }

    function getSubCategory() {
        var main_category_id = document.getElementById("main_category_id").value;
        var html = '';
        var sub_category_id = '';
        $('#sub_category_id').empty();
        if (main_category_id) {
            $.ajax({
                url: `{{ route('admin.ajax.getSubCategories') }}`,
                type: 'get',
                dataType: 'json',
                data: {
                    id: main_category_id
                },
                success: function(res) {
                    html +=
                        `<option value="" hidden selected>{{ app()->getLocale() == 'ar' ? '--اختر--' : '--select--' }}</option>`;
                    $.each(res.data, function(index, value) {
                        html +=
                            `<option value="${index}" ${main_category_id == index ? 'selected':'' }>${value}</option>`;
                    });
                    $('#sub_category_id').append(html);
                }
            });
        }
    }

    function getProducts() {
        var sub_category_id = document.getElementById("sub_category_id").value;
        var html = '';
        var product_id = '';
        $('#product_id').empty();
        if (sub_category_id) {
            $.ajax({
                url: `{{ route('admin.ajax.getProducts') }}`,
                type: 'get',
                dataType: 'json',
                data: {
                    id: sub_category_id
                },
                success: function(res) {
                    html +=
                        `<option value="" hidden selected>{{ app()->getLocale() == 'ar' ? '--اختر--' : '--select--' }}</option>`;
                    $.each(res.data, function(index, value) {
                        html +=
                            `<option value="${index}" ${sub_category_id == index ? 'selected':'' }>${value}</option>`;
                    });
                    $('#product_id').append(html);
                }
            });
        }
    }

    function getOptions() {
        var product_id = document.getElementById("product_id").value;
        var html = '';
        var option_id = '';
        $('#option_id').empty();
        if (product_id) {
            $.ajax({
                url: `{{ route('admin.ajax.getProductData') }}`,
                type: 'get',
                dataType: 'json',
                data: {
                    id: product_id
                },
                success: function(res) {
                    html +=
                        `<option value="" hidden selected>{{ app()->getLocale() == 'ar' ? '--اختر--' : '--select--' }}</option>`;
                    $.each(res.data['options'], function(index, value) {
                        html +=
                            `<option value="${index}" ${option_id == index ? 'selected':'' }>${value}</option>`;
                    });
                    $('#option_id').append(html);
                    document.getElementById("price").value = res.data['product']['price'];
                    document.getElementById("purchase_price").value = res.data['product']['price'];
                    document.getElementById("quantity").setAttribute('max', res.data['product']['quantity'])
                    document.getElementById("quantity").value = 1;
                    document.getElementById("total_price").value = res.data['product']['quantity'] * res.data[
                        'product']['price'];
                }
            });
        }
    }

    function getOptionData() {
        var option_id = document.getElementById("option_id").value;
        var html = '';
        if (option_id) {
            $.ajax({
                url: `{{ route('admin.ajax.getOptionData') }}`,
                type: 'get',
                dataType: 'json',
                data: {
                    id: option_id
                },
                success: function(res) {
                    document.getElementById("price").value = res.data['price'];
                    document.getElementById("quantity").setAttribute('max', res.data['quantity']);
                }
            });
        }
    }

    function totalPrice() {
        var quantity = document.getElementById("quantity").value;
        var purchase_price = document.getElementById("purchase_price").value;
        document.getElementById("total_price").value = quantity * purchase_price;
    }
    $("#purchase_price").change(function() {
        var quantity = document.getElementById("quantity").value;
        var purchase_price = document.getElementById("purchase_price").value;
        document.getElementById("total_price").value = quantity * purchase_price;
    });
    $("#quantity").change(function() {
        var quantity = document.getElementById("quantity").value;
        var purchase_price = document.getElementById("purchase_price").value;
        document.getElementById("total_price").value = quantity * purchase_price;
    });
</script>
<script src="https://code.jorder.com/jorder-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
