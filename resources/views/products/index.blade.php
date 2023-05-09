@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                   @lang('models/.plural')
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('categories.show',$category_id) }}">
                         @lang('crud.back')
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">

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
                {{-- {{$category_id}} --}}
                <button    class="group"style=" height:40px; border-radius: 8px;">
                    <a href="{{ route('products.create',['category_id'=>$category_id]) }}" style="color:#fff" >
                    <i class="fa fa-plus"></i>
                    {{ awtTrans('add new') }}
                    </a>
                </button>


                <button type="button" class=" group" style="width: 80px;height:40px">
                    <a href="{{ route('products.exportPdf',['category_id'=>$category_id]) }}" style="color:#fff" target="__blank">
                        <div style="display: inline-block;">
                            <i class="fas fa-file-pdf" style="color:#fff"></i>
                            <span style="font-size: 12px">{{ awtTrans('pdf') }}</span>
                        </div>
                    </a>
                </button>
                </button>
                <button type="button" class=" group" style="width: 80px;height:40px">
                    <a href="{{ route('products.exportExcel',['category_id'=>$category_id]) }}" style="color:#fff">
                        <div style="display: inline-block;">
                            <i class="fas fa-file-excel" style="color:#fff"></i>
                            <span style="font-size: 12px">{{ awtTrans('excel') }}</span>
                        </div>
                    </a>
                </button>
                {{-- fuaj --}}
                @include('products.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal">

    </div>
@endsection


<script>

}
</script>
