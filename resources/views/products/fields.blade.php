
<div class="form-group col-sm-6">
    {!! Form::label('image_path', 'Image:') !!}
    @if (isset($product))
    <p><img
        src='{{ dashboard_url($product->image_path) }}'
      style="width:100px">
    </p>
    @endif
    {!! Form::file('image_path') !!}
</div>
<div class="clearfix"></div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/categories.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('description', __(awtTrans('Description')).':') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4, 'cols' => 54]) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', __('models/products.fields.price').':') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('discount', __('models/products.fields.discount').':') !!}
    {!! Form::number('discount',null, ['class' => 'form-control']) !!}
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    {!! Form::hidden('category_id',$category_id,null, ['class' => 'form-control custom-select']) !!}
</div>




<!-- Discount Type Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('discount_type', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('discount_type', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('discount_type', __('models/products.fields.ratio'), ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', __('models/products.fields.quantity').':') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
</div>

