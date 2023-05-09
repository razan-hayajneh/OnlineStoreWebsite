@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                     @lang('models/sliders.singular')
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'sliders.store', 'files' => true,' enctype' => 'multipart/form-data']) !!}

            <div class="card-body">
                <div class="row">
                    @include('sliders.fields')
                </div>
            </div>

            {{-- <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('sliders.index') }}" class="btn btn-default">
                 @lang('crud.cancel')
                </a>
            </div> --}}

            {!! Form::close() !!}

        </div>
    </div>
@endsection
