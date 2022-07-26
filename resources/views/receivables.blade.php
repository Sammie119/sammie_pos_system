@extends('layout.app')

@section('title', 'POS | Receivables')

@section('content')
    <div class="container px-3 px-lg-5">
        <article class="resume-wrapper mx-auto theme-bg-light p-2 mb-5 my-5 shadow-lg">
            
            <div class="resume-header">
                <div class="row align-items-center">
                    <div class="resume-title col-12 col-md-6 col-lg-8 col-xl-10">
                        <h2 class="resume-name mb-0 text-uppercase" style="padding-left: 4rem;">Enter Receivables</h2>
                    </div><!--//resume-title-->
                    <div class="resume-contact col-12 col-md-6 col-lg-4 col-xl-2">
                        <a href="{{ route('receivables_list') }}" class="btn btn-success">Receivables</a>
                    </div><!--//resume-contact-->
                </div><!--//row-->
                
            </div><!--//resume-header-->
            <hr>
            <div class="resume-intro py-3" style="padding: 4rem 4rem;">
                <form action="{{ route('store_receivable') }}" method="POST" autocomplete="off" class="row g-3">
                    @csrf
                    
                    @include('forms.receivables_form')

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
                                    <div class="form-group col-5">
                                        <select class="form-control bg-white" ><option value="" selected>${data.brand} - ${data.product_description}</option></select>
                                    </div>
                                    <div class="form-group col-2">
                                        <input type="number" min="0" step="1" class="form-control bg-white" name="quantity[]" required>
                                    </div>                               
                                    <div class="form-group col-2">
                                        <input type="number" min="0" step="0.01" class="form-control bg-white sub_total" name="amount[]" required>
                                    </div>
                                    <div class="form-group col-1">
                                        <input type="button" class="btn btn-danger btn-sm bottn_delete" value="Del">
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

            // Add all amounts
            function TotalAmount(){
                var totalAmount = 0;
                $('.sub_total').each(function(i, e){
                    var s_total = $(this).val() - 0;
                    totalAmount += s_total;
                });

                $('.total_amount').val(totalAmount.toFixed(2));
            }

            $('.getTotalAmount').delegate('.sub_total', 'keyup', function(){
                // var div = $(this).parent().parent();
                // var qty = div.find('.quantity').val() - 0;
                // var price = div.find('.price').val() - 0;
                // var total = qty * price;
                // div.find('.sub_total').val(total);
                TotalAmount();
            });

            // delete row and subtract from total amount
            $('.getTotalAmount').delegate('.bottn_delete', 'click', function(){
                var div = $(this).parent().parent();
                var sub_total = div.find('.sub_total').val() - 0;
                var total_amount = $('.total_amount').val() - 0;
                var new_total = total_amount - sub_total;

                $('.total_amount').val(new_total.toFixed(2));
                //  alert(price);
                 div.remove();
            });

            
        };
        
    </script>
@endpush

@endsection
