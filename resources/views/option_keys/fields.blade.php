<!-- Key Field -->
<div class="form-group col-sm-6">
    {!! Form::label('key', __('awt.key').':') !!}
    {!! Form::text('key', null, ['class' => 'form-control']) !!}
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
