@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>@lang('models/orders.singular')</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('orders.index') }}">
                         @lang('crud.back')
                    </a>
                     <a class="btn btn-primary float-right  mx-4"
                       href="{{ route('order.exportOrderPdf',['id'=>$order->id]) }}" target="__blank">
                       <i class="fas fa-file-pdf" style="color:#fff"></i>
                       <span style="font-size: 12px">{{ __('awt.pdf') }}</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card">
            @include('flash::message')
            <div class="card-body">
                <div class="row">
                    @include('orders.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
