@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @lang('models/optionKeys.plural')
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <button class="btn btn-success btn-round-2">
            {{ 'Option : ' }}{{ $option['name'] }}
        </button>

        @include('flash::message')
        @if (\Session::has('message'))
            <div class="alert alert-danger">
                <ul>
                    <li>{!! \Session::get('message') !!}</li>
                </ul>
            </div>
        @endif

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-8">
                <button class="group"style=" height:40px; border-radius: 8px;">
                    <a href="{{ route('optionKeys.create', ['id' => $option['id']]) }}" style="color:#fff">
                        <i class="fa fa-plus"></i>
                        @lang('crud.add_new')
                    </a>
                </button>

                <button type="button" class=" group" style="width: 80px;height:40px">
                    <a href="{{ route('optionKeys.exportPdf', $option['id']) }}" style="color:#fff" target="__blank">
                        <div style="display: inline-block;">
                            <i class="fas fa-file-pdf" style="color:#fff"></i>
                            <span style="font-size: 12px">{{ __('awt.pdf') }}</span>
                        </div>
                    </a>
                </button>
                </button>
                <button type="button" class=" group" style="width: 80px;height:40px">
                    <a href="{{ route('optionKeys.exportExcel', $option['id']) }}" style="color:#fff">
                        <div style="display: inline-block;">
                            <i class="fas fa-file-excel" style="color:#fff"></i>
                            <span style="font-size: 12px">{{ __('awt.excel') }}</span>
                        </div>
                    </a>
                </button>
                @include('option_keys.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
