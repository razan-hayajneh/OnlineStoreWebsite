<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/categories.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>
<!-- Active Field -->

{{-- @if($category->active ==0) --}}
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::checkbox('active', 1, null, ['class' => 'form-check-input']) !!}
        {!! Form::label('active', __('models/categories.fields.active').':', ['class' => 'form-check-label']) !!}
    </div>
</div>
<div class="form-group col-sm-6">
    {!! Form::label('image_path', 'Image:') !!}
    @if (isset($category))
    <p><img
        src='{{ dashboard_url($category->image_path) }}'
      style="width:100px">
    </p>
    @endif
    {!! Form::file('image_path') !!}
</div>
<div class="clearfix"></div>
<script>
    document.getElementById("custom-select").selectedIndex = -1;
</script>
