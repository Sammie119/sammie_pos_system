@extends('layout.app')

@section('title', 'POS | Products Price History')

@section('content')
    <div class="container-fluid px-3 px-lg-5">
        <article class="resume-wrapper mx-auto theme-bg-light p-3 mb-5 my-5 shadow-lg">
            
            <div class="resume-header">
                <div class="row align-items-center">
                    <div class="resume-title col-12 col-md-6 col-lg-8 col-xl-10">
                        <h2 class="resume-name mb-0 text-uppercase" style="padding-left: 2rem;">Products Price History</h2>
                    </div><!--//resume-title-->
                    <div class="resume-contact col-12 col-md-6 col-lg-4 col-xl-2">
                        <a href="{{ route('products_list') }}" class="btn btn-success">Products</a>
                    </div><!--//resume-contact-->
                </div><!--//row-->  
            </div><!--//resume-header-->
            <hr>
            <div class="resume-intro py-3" style="padding: 2rem 2rem;">
                <div class="row align-items-center">
                    <table class="table table-striped table-advance table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Prodct Name (Brand)</th>
                                <th>Code</th>
                                <th>Old Cost P.</th>
                                <th>Old Selling P.</th>
                                <th>New Cost P.</th>
                                <th>New Selling P.</th>
                                <th>Date Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $key => $product)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $product->product->name }} ({{ $product->product->brand }})</td>
                                    <td>{{ $product->product->code }}</td>
                                    <td>{{ $product->old_cost }}</td>
                                    <td>{{ $product->old_price }}</td>
                                    <td>{{ $product->new_cost }}</td>
                                    <td>{{ $product->new_price }}</td>
                                    <td>{{ $product->updated_at }}</td>
                                    <td>
                                        <a class="btn btn-success" href="edit_price_history/{{ $product->id }}" title="Edit" style="padding: 0 7px 0 7px; height: 28px;"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-danger" onclick="return confirm('This History will be deleted permanently!!!')" href="#/{{ $product->id }}" title="Delete" style="padding: 0 7px 0 7px; height: 28px;"><i class="fas fa-user-times"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="40">No Data Found</td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                    </table>
                    
                </div>
            </div><!--//resume-intro-->

            <hr>
            
            <div class="resume-footer text-center" style="margin-bottom: 1rem;">
                @include('layout.footer')
            </div><!--//resume-footer-->
            
        </article>
        
    </div><!--//container-->

@endsection
