<!-- Name Field -->
<div class="form-group col-sm-3">
    <div class="form-group col-sm-12" style="text-align-last: center;    ">
        <img src="{{ dashboard_url($client->user->profile_photo_path) }}"
            style="width: 100px;height: 100px;border-radius: 100%;">
    </div>
    <div class="form-group col-sm-12" style="text-align-last: center;">
        <p>{{ $client->first_name . ' ' . $client->last_name }}</p>
        <p>{!! $client->user->name !!}</p>
        <p>{!! $client->user->email !!}</p>
        <p>{!! $client->user->user_status == 'active'
            ? '<button  class="btn btn-success btn-round-2">' .
                __('models/clients.fields.' . $client->user->user_status) .
                '</button>'
            : '<button  class="btn btn-danger btn-round-2">' .
                __('models/clients.fields.' . $client->user->user_status) .
                '</button>' !!}</p>
    </div>
</div>
<div class="form-group col-sm-8">
    <!-- Address Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('address', __('models/clients.fields.address') . ':') !!}
        {{ $client->address }}
    </div>
    <div class="form-group col-sm-4">
        {!! Form::label('phone', __('models/clients.fields.phone') . ':') !!}
        {!! $client->phone !!}
    </div>
    <!-- Created At Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('created_at', __('models/clients.fields.created_at') . ':') !!}
        {{ $client->created_at }}
    </div>

    <!-- Updated At Field -->
    <div class="form-group col-sm-4">
        {!! Form::label('updated_at', __('models/clients.fields.updated_at') . ':') !!}
        {{ $client->updated_at }}
    </div>
</div>
