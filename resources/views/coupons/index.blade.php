@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @lang('models/coupons.plural')
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-8">
                <button class="group"style=" height:40px; border-radius: 8px;">
                    <a href="{{ route('coupons.create') }}" style="color:#fff">
                        <i class="fa fa-plus"></i>
                        {{ __('awt.add_new') }}
                    </a>
                </button>
                @include('coupons.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
