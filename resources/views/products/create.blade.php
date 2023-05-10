@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    @lang('models/products.singular')
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'products.store', 'files' => true]) !!}

            <div class="card-body">
                <div class="row">
                    @include('products.fields')


                    <div style="width: 100%">
                        <hr style="border-top: 1px solid rgb(107 109 143 / 84%);">
                        <!-- option Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('option_id', __('models/products.fields.option') . ':') !!}
                            {!! Form::select('option_id', $options, null, [
                                'class' => 'form-control custom-select ',
                                'id' => 'optionId',
                                'onchange' => 'getOptionKey()',
                                'placeholder'=>'--select option--'
                            ]) !!}
                        </div>

                        <!-- option key Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('option_key_id', __('models/products.fields.option_key') . ':') !!}
                            {!! Form::select(
                                'option_key_id',
                                isset($optionKeys) ? $optionKeys : [],
                                isset($product) ? $order->address->city_id : null,
                                [
                                    'class' => 'form-control custom-select ',
                                    'id' => 'optionKeyId',
                                ],
                            ) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('option_price', __('models/products.fields.option_price') . ':') !!}
                            {!! Form::number('option_price', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group col-sm-6">
                            {!! Form::label('option_quantity', __('models/products.fields.option_quantity') . ':') !!}
                            {!! Form::number('option_quantity', null, ['class' => 'form-control']) !!}
                        </div>

                    </div>
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                {{-- {{$category_id}} --}}
                <a href="{{ route('products.index', ['id' => $category_id]) }}" class="btn btn-default">
                    @lang('crud.cancel')
                </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
