<!-- Key Field -->
<div class="col-sm-12">
    {!! Form::label('key_en', __('awt.english_key').':') !!}
    <p>{{ $optionKey->key_en }}</p>
</div>

<div class="col-sm-12">
    {!! Form::label('key_ar', __('awt.arabic_key').':') !!}
    <p>{{ $optionKey->key_ar }}</p>
</div>

<!-- Option Id Field -->
<div class="col-sm-12">
    {!! Form::label('option_id', __('awt.option_name').':') !!}
    {{-- <p>{{ $optionKey->option_id }}</p> --}}
    <p>{{ $option->name }}</p>

</div>

{{-- <!-- Price Field -->
<div class="col-sm-12">
    {!! Form::label('price', __('models/optionKeys.fields.price').':') !!}
    <p>{{ $optionKey->price }}</p>
</div> --}}

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/optionKeys.fields.created_at').':') !!}
    <p>{{ $optionKey->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/optionKeys.fields.updated_at').':') !!}
    <p>{{ $optionKey->updated_at }}</p>
</div>

