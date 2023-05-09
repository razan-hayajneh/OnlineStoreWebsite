<!-- Email Field -->
<div class="col-sm-6">
    {!! Form::label('email', __('models/contacts.fields.email').':') !!}
    <p>{{ $contact->email }}</p>
</div>

<!-- Phone Field -->
<div class="col-sm-6">
    {!! Form::label('phone', __('models/contacts.fields.phone').':') !!}
    <p>{{ $contact->phone }}</p>
</div>

<!-- Phone2 Field -->
<div class="col-sm-6">
    {!! Form::label('phone2', __('models/contacts.fields.phone2').':') !!}
    <p>{{ $contact->phone2 }}</p>
</div>

<!-- Googlestore Field -->
<div class="col-sm-6">
    {!! Form::label('googleStore', __('models/contacts.fields.googleStore').':') !!}
    <p>{{ $contact->googleStore }}</p>
</div>

<!-- Appstore Field -->
<div class="col-sm-6">
    {!! Form::label('appStore', __('models/contacts.fields.appStore').':') !!}
    <p>{{ $contact->appStore }}</p>
</div>

<!-- Whatsapp Field -->
<div class="col-sm-6">
    {!! Form::label('whatsapp', __('models/contacts.fields.whatsapp').':') !!}
    <p >{{ $contact->whatsapp }}</p>
</div>

<!-- location Field -->
<div class="col-sm-12">
    {!! $contact->location  !!}
</div>



<!-- Created At Field -->
{{-- <div class="col-sm-6">
    {!! Form::label('created_at', __('models/contacts.fields.created_at').':') !!}
    <p>{{ $contact->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-6">
    {!! Form::label('updated_at', __('models/contacts.fields.updated_at').':') !!}
    <p>{{ $contact->updated_at }}</p>
</div>
 --}}
