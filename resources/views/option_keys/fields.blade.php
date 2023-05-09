<!-- Key Field -->
<div class="form-group col-sm-6">
    {!! Form::label('key_en', __('awt.english_key').':') !!}
    {!! Form::text('key_en', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('key_ar', __('awt.arabic_key').':') !!}
    {!! Form::text('key_ar', null, ['class' => 'form-control']) !!}
</div>

<!-- Option Id Field -->
<div class="form-group col-sm-6" style="display: none" >
    {!! Form::label(__('option_id'), __('models/optionKeys.fields.option_id').':') !!}
    {!! Form::number('option_id' ,$option['id'], ['class' => 'form-control custom-select']) !!}
</div>


<!-- Price Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('price', __('models/optionKeys.fields.price').':') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div> --}}
