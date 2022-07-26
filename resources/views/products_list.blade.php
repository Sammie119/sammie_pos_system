@extends('layout.app')

@section('title', 'POS | Products')

@section('content')
    <div class="container-fluid px-3 px-lg-5">
        <article class="resume-wrapper mx-auto theme-bg-light p-3 mb-5 my-5 shadow-lg">
            
            <div class="resume-header">
                <div class="row align-items-center">
                    <div class="resume-title col-12 col-md-6 col-lg-8 col-xl-10">
                        <h2 class="resume-name mb-0 text-uppercase" style="padding-left: 2rem;">Products List</h2>
                    </div><!--//resume-title-->
                    <div class="resume-contact col-12 col-md-6 col-lg-4 col-xl-2">
                        <a href="{{ route('add_product') }}" class="btn btn-success">Add Product</a>
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
                                <th>Name (Brand)</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Stock</th>
                                <th>Sold</th>
                                <th>Cost P.</th>
                                <th>Selling P</th>
                                <th>Value</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $key => $product)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $product->name }} ({{ $product->brand }})</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->stock_in }}</td>
                                    <td>{{ $product->stock_in - $product->stock_out }}</td>
                                    <td>{{ $product->stock_out }}</td>
                                    <td>{{ $product->cost }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->stock_in * $product->price }}</td>
                                    <td>
                                        <a class="btn btn-success" href="edit_product/{{ $product->id }}" title="Edit" style="padding: 0 7px 0 7px; height: 28px;"><i class="fas fa-edit"></i></a>
                                        <a class="btn btn-danger" onclick="return confirm('This Product will be deleted permanently!!!')" href="delete_product/{{ $product->id }}" title="Delete" style="padding: 0 7px 0 7px; height: 28px;"><i class="fas fa-user-times"></i></a>
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
