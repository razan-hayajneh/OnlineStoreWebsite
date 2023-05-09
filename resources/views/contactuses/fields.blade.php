<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/contactuses.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('models/contactuses.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- message Field -->
<div class="form-group col-sm-6">
    {!! Form::label('message', __('models/contactuses.fields.message').':') !!}
    {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
</div>
<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', __('models/contactuses.fields.phone').':') !!}
    {!! Form::number('phone', null, ['class' => 'form-control']) !!}
</div>
