@extends('layout.app')

@section('title', 'POS | Dashboard')
<link id="theme-style" rel="stylesheet" href="{{ asset('/assets/css/adminlte.css') }}">

@section('content')
    <div class="container-fluid px-3 px-lg-5">
        <article class="resume-wrapper mx-auto theme-bg-light p-3 mb-5 my-5 shadow-lg">

            <div class="resume-header">
                <div class="row align-items-center">
                    <div class="resume-title col-12 col-md-6 col-lg-8 col-xl-12">
                        <h2 class="resume-name mb-0 text-uppercase">{{ \App\Models\ShopSettings::find(1)->shop_name}}</h2>
                    </div><!--//resume-title-->
                </div><!--//row-->

            </div><!--//resume-header-->
            <hr>
            <div class="resume-intro py-3">

                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                        <h3 class="text-white">{{ number_format(\App\Models\Transaction::where('transac_date', date('Y-m-d'))->sum('amount_paid'), 2) }}</h3>

                        <p>Today's Amount</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-restroom"></i>
                        </div>
                        <a href="{{ route('transactions_list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                        <h3 class="text-white">{{ \App\Models\Product::count() }}</h3>

                        <p>Total Number of Products</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hospital-user"></i>
                        </div>
                        <a href="{{ route('products_list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                        <h3>{{ \App\Models\Supplier::count() }}</h3>

                        <p>Total Number of Suppliers</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-hospital-user"></i>
                        </div>
                        <a href="{{ route('suppliers_list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 class="text-white">{{ \App\Models\User::count() - 1 }}</h3>

                            <p>Total Number of Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-restroom"></i>
                        </div>
                        <a href="{{ route('users_list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    </div>
                    <!-- ./col -->
                </div>

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-6 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-bar mr-1"></i>
                                    Product Sales
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Details</a>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- /.card-header -->
                            <div class="card-body">

                                <ol class="list-group list-group-numbered">
                                    <li class="list-group-item">A list item</li>
                                    <li class="list-group-item">A list item</li>
                                    <li class="list-group-item">A list item</li>
                                </ol>

                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- /.Left col -->

                    <!-- right col -->
                    <section class="col-lg-6 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-bar mr-1"></i>
                                    Sales Persons
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Details</a>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- /.card-header -->
                            <div class="card-body">

                                <ol class="list-group list-group-numbered">
                                    <li class="list-group-item">A list item</li>
                                    <li class="list-group-item">A list item</li>
                                    <li class="list-group-item">A list item</li>
                                </ol>

                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- /.right col -->
                </div>
                <!-- /.row (main row) -->

            </div><!--//resume-intro-->
            <hr>

            <div class="resume-footer text-center" style="margin-bottom: 1rem;">
                @include('layout.footer')
            </div><!--//resume-footer-->
        </article>

    </div><!--//container-->

@endsection
