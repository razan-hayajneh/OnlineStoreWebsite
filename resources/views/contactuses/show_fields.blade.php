<!-- Name Field -->
<div class="col-sm-6">
    {!! Form::label('name', __('models/contactuses.fields.name').':') !!}
    <p>{{ $contactUs->name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-6">
    {!! Form::label('email', __('models/contactuses.fields.email').':') !!}
    <p>{{ $contactUs->email }}</p>
</div>

<!-- Message Field -->
<div class="col-sm-6">
    {!! Form::label('message', __('models/contactuses.fields.message').':') !!}
    <p>{{ $contactUs->message }}</p>
</div>

<!-- Phone Field -->
<div class="col-sm-6">
    {!! Form::label('phone', __('models/contactuses.fields.phone').':') !!}
    <p>{{ $contactUs->phone }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-6">
    {!! Form::label('created_at', __('models/contactuses.fields.created_at').':') !!}
    <p>{{ $contactUs->created_at }}</p>
</div>

{{-- <!-- Updated At Field -->
<div class="col-sm-6">
    {!! Form::label('updated_at', __('models/contactuses.fields.updated_at').':') !!}
    <p>{{ $contactUs->updated_at }}</p>
</div> --}}

