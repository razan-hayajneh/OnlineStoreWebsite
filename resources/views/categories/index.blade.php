
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">

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

                    <button    class="group"style=" height:40px; border-radius: 8px;">
                        <a href="{{ route('categories.create') }}" style="color:#fff" >
                        <i class="fa fa-plus"></i>
                        {{ awtTrans('add new') }}
                        </a>
                    </button>


                    <button type="button" class=" group" style="width: 80px;height:40px">
                        <a href="{{ route('categories.exportPdf') }}" style="color:#fff" target="__blank">
                            <div style="display: inline-block;">
                                <i class="fas fa-file-pdf" style="color:#fff"></i>
                                <span style="font-size: 12px">{{ awtTrans('pdf') }}</span>
                            </div>
                        </a>
                    </button>
                    </button>
                    <button type="button" class=" group" style="width: 80px;height:40px">
                        <a href="{{ route('categories.exportExcel') }}" style="color:#fff">
                            <div style="display: inline-block;">
                                <i class="fas fa-file-excel" style="color:#fff"></i>
                                <span style="font-size: 12px">{{ awtTrans('excel') }}</span>
                            </div>
                        </a>
                    </button>
                @include('categories.table')

                <div class="card-footer clearfix float-right">
                    <div class="float-right">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


<script>
            function changeActive(id) {
            $.ajax({
                type     : 'get',
                url      : `{{route('category.changeStatus')}}`,
                datatype : 'json' ,
                data     : {
                    'id'         :  id
                }, success   : function(res){
                }
            });
        }
</script>
