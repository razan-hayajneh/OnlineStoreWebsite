@extends('layouts.app')

@push('css')
    <link href="{{ asset('assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css') }}" rel="stylesheet"
        type="text/css" />
    <style>
        .kt-portlet {
            padding: 0;
        }

        .general-info .user-data {
            margin-bottom: 1rem;
        }

        .general-info {
            color: #595d6e
        }
    </style>
@endpush
@section('content')
    <div style="margin-inline: 30px">
        <h1 style="color: #000">{{ awtTrans('Home') }}</h1>
        {{-- <h6 style="color: #000">{{ awtTrans('dashboard') }} / {{ awtTrans('show') }}</h6> --}}
    </div>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <!--Begin::Dashboard 1-->
            <!--Begin::Row-->
            <!--Start The New Content  -->
            <div class="row">

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <div class="info-box-content">
                            <h5 style="color: #000">{{ awtTrans('العملاء') }}</h5>
                            <h4>
                                {{ $numberOfClient }}
                                {{-- <small>%</small> --}}
                            </h4>
                        </div>
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">

                        <div class="info-box-content">
                            <h5 style="color: #000">{{ awtTrans('الطلبيات الجديدة') }}</h5>
                            <h4>{{ 2 }}</h4>
                        </div>
                        <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-user"></i></span>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">

                        <div class="info-box-content">
                            <h5 style="color: #000">{{ awtTrans('المنتجات') }}</h5>
                            <h4>{{ 5 }}</h4>
                        </div>
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-database"></i></span>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                {{-- <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">

                        <div class="info-box-content">
                            <h5 style="color: #000">{{ awtTrans('الدول') }}</h5>
                            <h4>{{ 5 }}</h4>
                        </div>
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-globe"></i></span>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div> --}}
                <div class="col-lg-12">
                    <div class="kt-portlet kt-portlet--height-fluid">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <div class="form-grocomposeup form-inline py-2 my-0">
                                    <h3 class="kt-portlet__head-title">
                                        {{ awtTrans('الطلبيات') }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <canvas id="myChart" style="width:100%;max-width:700px"></canvas>


                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <!-- End  The New Content  -->




            <!--End::Row-->
            <!--End::Dashboard 1-->
        </div>
        <!-- end:: Content -->
    </div>
@endsection
@push('third_party_scripts')
    <script type="text/javascript">
        new Chart("myChart", {
            type: "bar",
            data: {
                labels: [`{{ awtTrans('January') }}`, `{{ awtTrans('February') }}`, `{{ awtTrans('March') }}`,
                    `{{ awtTrans('April') }}`, `{{ awtTrans('May') }}`, `{{ awtTrans('June') }}`,
                    `{{ awtTrans('July') }}`, `{{ awtTrans('august') }}`, `{{ awtTrans('Septemper') }}`,
                    `{{ awtTrans('October') }}`, `{{ awtTrans('Novmber') }}`, `{{ awtTrans('December') }}`
                ],
                datasets: [{
                    backgroundColor: '#687cdf',
                    data: [10, 12, 44, 48, 89, 95, 54, 45, 45, 41, 21, 48]
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                    // generateLabels: function(data) {
                    //     return data.text;
                    // }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        stacked: true
                    }],
                    xAxes: [{
                        stacked: true,
                    }]
                }
            }
        });
    </script>
@endpush
