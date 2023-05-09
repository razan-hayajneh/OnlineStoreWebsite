<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', __('models/coupons.fields.code').':') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}

</div>

<!-- Is Ratio Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_ratio', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_ratio', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_ratio', __('models/coupons.fields.is_ratio'), ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description_en', __('awt.english_desc').':') !!}
    {!! Form::textarea('description_en', null, ['class' => 'form-control', 'rows' => 4, 'cols' => 54]) !!}
</div>
<div class="form-group col-sm-6">
    {!! Form::label('description_ar', __('awt.arabic_desc').':') !!}
    {!! Form::textarea('description_ar', null, ['class' => 'form-control', 'rows' => 4, 'cols' => 54]) !!}
</div>




<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value', __('models/coupons.fields.value').':') !!}
    {!! Form::number('value', null, ['class' => 'form-control']) !!}
</div>

<!-- Expiration Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('expiration_date', __('models/coupons.fields.expiration_date').':') !!}
   {!! Form::date('expiration_date',isset($coupon)? $coupon->expiration_date :null, ['class' => 'form-control','id'=>'expiration_date']) !!} 



</div>

@push('page_scripts')
  
@endpush
