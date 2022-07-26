@extends('layout.app')

@section('title', 'POS | Edit Product Restock')

@section('content')
    <div class="container px-3 px-lg-5">
        <article class="resume-wrapper mx-auto theme-bg-light p-2 mb-5 my-5 shadow-lg">
            
            <div class="resume-header">
                <div class="row align-items-center">
                    <div class="resume-title col-12 col-md-6 col-lg-8 col-xl-10">
                        <h2 class="resume-name mb-0 text-uppercase" style="padding-left: 4rem;">Edit Product Restock</h2>
                    </div><!--//resume-title-->
                    <div class="resume-contact col-12 col-md-6 col-lg-4 col-xl-2">
                        <a href="{{ route('products_list') }}" class="btn btn-success">Products</a>
                    </div><!--//resume-contact-->
                </div><!--//row-->
                
            </div><!--//resume-header-->
            <hr>
            <div class="resume-intro py-3" style="padding: 4rem 4rem;">
                <form action="{{ route('update_restock_product') }}" method="POST" autocomplete="off" class="row g-3">
                    @csrf

                    <input type="hidden" name="id" value="{{ $product->id }}"> 
                    <div class="row mb-2">
                        <div class="col-md-2">
                            <label for="recipient-name" class="control-label">Code</label>
                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="control-label">Product (Description)</label>
                        </div>
                        <div class="col-md-2">
                            <label for="recipient-name" class="control-label">Stock</label>
                        </div>
                        <div class="col-md-2">
                            <label for="recipient-name" class="control-label">Quantity</label>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="form-group col-2">
                            <select class="form-control bg-white" name="product_id" required>
                                <option value="{{ $product->product_id }}" selected>{{ $product->product->code }}</option>
                            </select>
                        </div> 
                        <div class="form-group col-6">
                            <select class="form-control bg-white" ><option value="" selected>{{ $product->product->name }} ({{ $product->product->description }})</option></select>
                        </div>                               
                        <div class="form-group col-2">
                            <select class="form-control bg-white" name="stock"><option selected>{{ $product->old_sold}}</option></select>
                        </div>
                        <div class="form-group col-2">
                            <input type="number" min="0" step="1" value="{{ $product->new_quantity}}" class="form-control bg-white" name="quantity" required>
                        </div> 
                    </div>

                    <div class="col-12">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
            </div><!--//resume-intro-->
            <hr>
            
            <div class="resume-footer text-center" style="margin-bottom: 1rem;">
                @include('layout.footer')
            </div><!--//resume-footer-->
        </article>
        
    </div><!--//container-->

@endsection
