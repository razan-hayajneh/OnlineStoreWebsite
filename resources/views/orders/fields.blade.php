<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('client_id', __('models/orders.fields.client_id') . ':') !!}
    {!! Form::text('client', $order?->user->name?? null, ['class' => 'form-control disabled']) !!}
    {!! Form::id('client_id',  null, ['class' => 'form-control hidden']) !!}
</div>


<!-- Total Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_price', __('models/orders.fields.total_price') . ':') !!}
    {!! Form::number('total_price', null, ['class' => 'form-control','step'=>'0.01']) !!}
</div>

<!-- Coupoun Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('coupoun_id', __('models/orders.fields.coupoun_id') . ':') !!}
    {!! Form::select('coupoun_id', $coupouns,  $order?->coupon->code?? null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Final Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('coupon_value', __('models/orders.fields.coupon_value') . ':') !!}
    {!! Form::number('coupon_value', isset($order) ? $order->coupon?->value : null, ['class' => 'form-control','step'=>'0.01','readonly']) !!}
</div>
<!-- Final Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('final_price', __('models/orders.fields.final_price') . ':') !!}
    {!! Form::number('final_price', null, ['class' => 'form-control','step'=>'0.01']) !!}
</div>

<!-- Tax Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tax', __('models/orders.fields.tax') . ':') !!}
    {!! Form::number('tax', null, ['class' => 'form-control','step'=>'0.01']) !!}
</div>
<br>

<!-- Address Field -->
<div class="form-group col-sm-3">
    {!! Form::label('address', __('models/addresses.fields.address') . ':') !!}
    {!! Form::text('address', isset($order) ? $order->address : null, ['class' => 'form-control']) !!}
</div>


