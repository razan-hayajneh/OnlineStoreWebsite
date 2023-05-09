<!-- Code Field -->
<div class="col-sm-12">
    {!! Form::label('code', __('models/coupons.fields.code').':') !!}
    <p>{{ $coupon->code }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description_en', __('awt.english_desc').':') !!}
    <p>{{ $coupon->description_en }}</p>
</div>
<div class="col-sm-12">
    {!! Form::label('description_ar', __('awt.arabic_desc').':') !!}
    <p>{{ $coupon->description_ar }}</p>
</div>

<!-- Is Ratio Field -->
<div class="col-sm-12">
    {!! Form::label('is_ratio', __('models/coupons.fields.is_ratio').':') !!}
    <p>{{ $coupon->is_ratio == "1" ? __('awt.ratio') : __('awt.fixed')}}</p>
</div>

<!-- Value Field -->
<div class="col-sm-12">
    {!! Form::label('value', __('models/coupons.fields.value').':') !!}
    <p>{{ $coupon->value }}</p>
</div>

<!-- Expiration Date Field -->
<div class="col-sm-12">
    {!! Form::label('expiration_date', __('models/coupons.fields.expiration_date').':') !!}
    <p>{{ $coupon->expiration_date }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/coupons.fields.created_at').':') !!}
    <p>{{ $coupon->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/coupons.fields.updated_at').':') !!}
    <p>{{ $coupon->updated_at }}</p>
</div>

