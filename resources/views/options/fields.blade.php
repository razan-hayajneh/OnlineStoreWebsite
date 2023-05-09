<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name_en', __('models/categories.fields.name_en').':') !!}
    {!! Form::text('name_en', null, ['class' => 'form-control']) !!}

    {!! Form::label('name_ar', __('models/categories.fields.name_ar').':') !!}
    {!! Form::text('name_ar', null, ['class' => 'form-control']) !!}
</div>