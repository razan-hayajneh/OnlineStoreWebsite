<!-- Icon Field -->
<div class="col-sm-12">
    {!! Form::label('icon', __('models/socialMedia.fields.icon').':') !!}
    <p>{{ $socialMedia->icon }}</p>
</div>

<!-- Key Field -->
<div class="col-sm-12">
    {!! Form::label('key', __('models/socialMedia.fields.key').':') !!}
    <p>{{ $socialMedia->key }}</p>
</div>

<!-- Url Field -->
<div class="col-sm-12">
    {!! Form::label('url', __('models/socialMedia.fields.url').':') !!}
    <p>{{ $socialMedia->url }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/socialMedia.fields.created_at').':') !!}
    <p>{{ $socialMedia->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/socialMedia.fields.updated_at').':') !!}
    <p>{{ $socialMedia->updated_at }}</p>
</div>

