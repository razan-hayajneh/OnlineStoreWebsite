@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @lang('models/orders.plural')
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-8">
                <button type="button" class=" group" style="width: 80px;height:40px">
                    <a href="{{ route('order.exportPdf') }}" style="color:#fff" target="__blank">
                        <div style="display: inline-block;">
                            <i class="fas fa-file-pdf" style="color:#fff"></i>
                            <span style="font-size: 12px">{{ __('awt.pdf') }}</span>
                        </div>
                    </a>
                </button>
                <button type="button" class=" group" style="width: 80px;height:40px">
                    <a href="{{ route('order.exportExcel') }}" style="color:#fff">
                        <div style="display: inline-block;">
                            <i class="fas fa-file-excel" style="color:#fff"></i>
                            <span style="font-size: 12px">{{ __('awt.excel') }}</span>
                        </div>
                    </a>
                </button>
                @include('orders.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
