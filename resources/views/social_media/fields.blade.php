<!-- Icon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('icon', __('models/socialMedia.fields.icon').':') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('icon', ['class' => 'custom-file-input']) !!}
            {!! Form::label('icon', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>
<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('key', __('models/socialMedia.fields.key').':') !!}
    {!! Form::text('key', null, ['class' => 'form-control']) !!}
</div>
<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('url', __('models/socialMedia.fields.url').':') !!}
    {!! Form::text('url', null, ['class' => 'form-control']) !!}
</div>
