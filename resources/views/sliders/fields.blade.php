<div class="form-group col-sm-12">
    {!! Form::label('image', 'New image:') !!}
    {!! Form::file('image') !!}
</div>

<div class="card-footer">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('sliders.index') }}" class="btn btn-default">
     @lang('crud.cancel')
    </a>
</div>
