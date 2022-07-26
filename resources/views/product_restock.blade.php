@extends('layout.app')

@section('title', 'POS | Restock Product')

@section('content')
    <div class="container px-3 px-lg-5">
        <article class="resume-wrapper mx-auto theme-bg-light p-3 mb-5 my-5 shadow-lg">
            
            <div class="resume-header">
                <div class="row align-items-center">
                    <div class="resume-title col-12 col-md-6 col-lg-8 col-xl-10">
                        <h2 class="resume-name mb-0 text-uppercase">Restock Products</h2>
                    </div><!--//resume-title-->
                    <div class="resume-contact col-12 col-md-6 col-lg-4 col-xl-2">
                        <a href="{{ route('product_restock_history') }}" class="btn btn-success">History</a>
                    </div><!--//resume-contact-->
                </div><!--//row-->
                
            </div><!--//resume-header-->
            <hr>
            <div class="resume-intro py-3">
                
                <div class="col-md-12">
                    <div class="row ">
                        <div class="form-group col-md-6">
                            <label for="recipient-name" class="control-label">Enter Product</label>
                            <input type="text" class="form-control form-control-border product" list="datalistOptions" placeholder="Enter Product" autofocus>
                            <datalist id="datalistOptions">
                                @forelse ( \App\Models\Product::select('name', 'code', 'brand')->orderBy('name')->get() as $product)
                                    <option value="{{ $product->code }}">{{ $product->name }} ({{ $product->brand }})</option>
                                @empty
                                    <option value="No Data Found">
                                @endforelse
                            </datalist> 
                        </div>
                        <div class="form-group col-md-1">
                        <label for="recipient-name" class="control-label">Action</label>
                        <a class="form-control btn btn-success addProduct">Add</a>
                    </div>
                    </div>
                </div>
    
                <hr>
    
                <div class="col-md-12">
                    <div class="row ">
                        <div class="col-md-2">
                            <label for="recipient-name" class="control-label">Code</label>
                        </div>
                        <div class="col-md-6">
                            <label for="recipient-name" class="control-label">Product (Description)</label>
                        </div>
                        <div class="col-md-1">
                            <label for="recipient-name" class="control-label">Stock</label>
                        </div>
                        <div class="col-md-2">
                            <label for="recipient-name" class="control-label">Quantity</label>
                        </div>
                        <div class="col-md-1">
                            <label for="recipient-name" class="control-label">Action</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 form_field_outer p-0">
                    <form action="{{ route('store_restock_product') }}" method="POST" autocomplete="off">
                        @csrf
                        <div class="col-md-12 mt-2" id="contentProduct">
                            <div class="show_data">No Data Found</div>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> 
                    </form>                   
                </div>

            </div><!--//resume-intro-->

            <hr>
            
            <div class="resume-footer text-center" style="margin-bottom: 1rem;">
                @include('layout.footer')
            </div><!--//resume-footer-->
        </article>
        
    </div><!--//container-->

    @push('scripts')
        <script>
            window.onload = function(){
                $("body").on("click",".addProduct", function (){
                    var product = $('.product').val();
                    if(product === ''){
                        alert('Product Input Empty!!!');
                    }else {
                        $.ajax({
                        type:'GET',
                        url:"search_product",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            product
                            },
                        success:function(data) {
                            if(data.product_name === 'No_data'){
                                alert('Product does not Exist!!!');
                            }else{
                                document.querySelector('#contentProduct').insertAdjacentHTML(
                                    'beforeend',
                                    `<div class="row mb-2">
                                        <div class="form-group col-2">
                                            <select class="form-control bg-white" name="product_id[]" required>
                                                <option value="${data.product_id}" selected>${data.code}</option>
                                            </select>
                                        </div> 
                                        <div class="form-group col-6">
                                            <select class="form-control bg-white" ><option value="" selected>${data.product_description}</option></select>
                                        </div>                               
                                        <div class="form-group col-1">
                                            <select class="form-control bg-white" name="stock[]"><option selected>${data.stock}</option></select>
                                        </div>
                                        <div class="form-group col-2">
                                            <input type="number" min="0" step="1" placeholder="0" class="form-control bg-white" name="quantity[]" required>
                                        </div> 
                                        <div class="form-group col-1">
                                            <input type="button" class="btn btn-danger btn-sm" value="Del" onclick="removeRow(this)">
                                        </div>
                                    </div>`      
                                );
                            }

                            document.querySelector('.show_data').style.display='none';

                            $('.product').val('');
                            $('.product').focus();

                        }
                    });
                    }
                        
                });

            };
            
        </script>
    @endpush

    <script>
    
        function removeRow (input) {
            input.parentNode.parentElement.remove()
        }
    
    </script>

@endsection
