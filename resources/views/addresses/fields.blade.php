<!-- Order Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('order_id', __('models/addresses.fields.order_id').':') !!}
    {!! Form::number('order_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Latitude Field -->
<div class="form-group col-sm-6">
    {!! Form::label('latitude', __('models/addresses.fields.latitude').':') !!}
    {!! Form::number('latitude', null, ['class' => 'form-control']) !!}
</div>

<!-- Longitude Field -->
<div class="form-group col-sm-6">
    {!! Form::label('longitude', __('models/addresses.fields.longitude').':') !!}
    {!! Form::number('longitude', null, ['class' => 'form-control']) !!}
</div>

<!-- City Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city_id', __('models/addresses.fields.city_id').':') !!}
    {!! Form::select('city_id', null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Country Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_id', __('models/addresses.fields.country_id').':') !!}
    {!! Form::select('country_id', null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Neighborhood Field -->
<div class="form-group col-sm-6">
    {!! Form::label('neighborhood', __('models/addresses.fields.neighborhood').':') !!}
    {!! Form::text('neighborhood', null, ['class' => 'form-control']) !!}
</div>

<!-- Street Field -->
<div class="form-group col-sm-6">
    {!! Form::label('street', __('models/addresses.fields.street').':') !!}
    {!! Form::text('street', null, ['class' => 'form-control']) !!}
</div>

<!-- Residence Field -->
<div class="form-group col-sm-6">
    {!! Form::label('residence', __('models/addresses.fields.residence').':') !!}
    {!! Form::text('residence', null, ['class' => 'form-control']) !!}
</div>

<!-- Floor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('floor', __('models/addresses.fields.floor').':') !!}
    {!! Form::text('floor', null, ['class' => 'form-control']) !!}
</div>

<!-- House Field -->
<div class="form-group col-sm-6">
    {!! Form::label('house', __('models/addresses.fields.house').':') !!}
    {!! Form::text('house', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', __('models/addresses.fields.address').':') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>
