<!-- avatar Field -->
<div class="form-group col-sm-6">
    {!! Form::label('avatar', __('models/clients.fields.avatar') . ':') !!}
    <div class="input-group">
        @if (isset($client))
            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="! photoPreview">
                <img src="{{ $client?->profile_photo_path }}" alt="{{ $client?->name }}" class="rounded-full h-20 w-20 object-cover">
            </div>
        @endif
        <div class="custom-file">
            {!! Form::file('profile_photo_path', ['class' => 'custom-file-input']) !!}
            {!! Form::label('profile_photo_path', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/clients.fields.name') . ':') !!}
    {!! Form::text('name', isset($client) ? $client->user->name : null, ['class' => 'form-control']) !!}
</div>
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', __('models/clients.fields.first_name') . ':') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_name', __('models/clients.fields.last_name') . ':') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', __('models/clients.fields.email') . ':') !!}
    {!! Form::email('email', isset($client) ? $client->user->email : null, ['class' => 'form-control']) !!}
</div>
<!-- phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', __('models/clients.fields.phone') . ':') !!}
    {!! Form::text('phone', null, ['class' => 'form-control', 'type' => 'phone']) !!}
</div>
<!-- user_status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_status', __('models/clients.fields.user_status') . ':') !!}
    {!! Form::select('user_status', ['active'=>'active','deactivate'=>'deactivate'], isset($client) ? $client->user->user_status : null, [
        'class' => 'form-control custom-select ',
    ]) !!}
</div>
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', __('models/clients.fields.address') . ':') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>
<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', __('models/clients.fields.password') . ':') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>

<!-- Confirmation Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', __('models/clients.fields.password_confirmation') . ':') !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
</div>
