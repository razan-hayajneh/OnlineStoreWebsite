<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('models/contacts.fields.email').':') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>
<!-- phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', __('models/contacts.fields.phone').':') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>
<!-- phone 2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone2', __('models/contacts.fields.phone2').':') !!}
    {!! Form::text('phone2', null, ['class' => 'form-control']) !!}
</div>
<!-- whatsapp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('whatsapp', __('models/contacts.fields.whatsapp').':') !!}
    {!! Form::text('whatsapp', null, ['class' => 'form-control']) !!}
</div>
<!-- location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location', __('models/contacts.fields.location').':') !!}
    {!! Form::textArea('location', null, ['class' => 'form-control','step'=>0.00000001]) !!}
</div>
<!-- latitude Field -->
{{-- <div class="form-group col-sm-6">
    {!! Form::label('latitude', __('models/contacts.fields.latitude').':') !!}
    {!! Form::number('latitude', null, ['class' => 'form-control','step'=>0.00000001]) !!}
</div> --}}
