<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/products.fields.name').':') !!}
    <p>{{ $item->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/products.fields.description').':') !!}
    <p>{{ $item->description }}</p>
</div>

<!-- Price Field -->
<div class="col-sm-12">
    {!! Form::label('price', __('models/products.fields.price').':') !!}
    <p>{{ $item->price }}</p>
</div>

<!-- Category Id Field -->
<div class="col-sm-12">
    {!! Form::label('category_id', __('models/products.fields.category_id').':') !!}
    <p>{{ $item->category_id }}</p>
</div>

<!-- Quantity Field -->
<div class="col-sm-12">
    {!! Form::label('quantity', __('models/products.fields.quantity').':') !!}
    <p>{{ $item->quantity }}</p>
</div>

<!-- Discount Field -->
<div class="col-sm-12">
    {!! Form::label('discount', __('models/products.fields.discount').':') !!}
    <p>{{ $item->discount }}</p>
</div>

<!-- Discount Type Field -->
<div class="col-sm-12">
    {!! Form::label('discount_type', __('models/products.fields.discount_type').':') !!}
    <p>{{ $item->discount_type }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/products.fields.created_at').':') !!}
    <p>{{ $item->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/products.fields.updated_at').':') !!}
    <p>{{ $item->updated_at }}</p>
</div>

