<!-- Name Field -->

<div class="col-sm-12">
    {!! Form::label('name_en', __('models/categories.fields.name_en').':') !!}
    <p>{{ $option->name_en }}</p>
</div>
<div class="col-sm-12">
    {!! Form::label('name_ar', __('models/categories.fields.name_ar').':') !!}
    <p>{{ $option->name_ar }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/options.fields.created_at').':') !!}
    <p>{{ $option->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/options.fields.updated_at').':') !!}
    <p>{{ $option->updated_at }}</p>
</div>

