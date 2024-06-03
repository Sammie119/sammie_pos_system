@extends('layout.app')

@section('title', 'POS | Transactions')

@section('content')
    <div class="container px-3 px-lg-5">
        <article class="resume-wrapper mx-auto theme-bg-light p-2 mb-5 my-5 shadow-lg">

            <div class="resume-header">
                <div class="row align-items-center">
                    <div class="resume-title col-12 col-md-6 col-lg-8 col-xl-10">
                        <h2 class="resume-name mb-0 text-uppercase" style="padding-left: 4rem;">Generate Invoice</h2>
                    </div><!--//resume-title-->
                    <div class="resume-contact col-12 col-md-6 col-lg-4 col-xl-2">
                        @if (Auth()->user()->role == 1)
                            <a href="{{ route('transactions_list') }}" class="btn btn-success">Invoices</a>
                        @else
                            <a href="{{ route('transactions_list_user') }}" class="btn btn-success">Invoices</a>
                        @endif

                    </div><!--//resume-contact-->
                </div><!--//row-->

            </div><!--//resume-header-->
            <hr>
            <div class="resume-intro py-3" style="padding: 4rem 4rem;">
                <form action="{{ (Auth()->user()->role == 1) ? route('store_transaction') : route('store_transaction_user') }}" method="POST" autocomplete="off" class="row g-3">
                    @csrf

                    @include('forms.transactions_form')

                    <div class="col-12 ms-auto">
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
                                    <div class="form-group col-6">
                                        <select class="form-control bg-white" name="product_id[]"><option value="${data.product_id}" selected>${data.product_description}</option></select>
                                    </div>
                                    <div class="form-group col-2">
                                        <input type="number" class="form-control bg-white px-0 quantity" name="quantity[]" style="text-align: center;" required>
                                    </div>
                                    <div class="form-group col-1">
                                        <select class="form-control bg-white px-0 price" name="unit_price[]" style="text-align: center;"><option selected>${data.price}</option></select>
                                    </div>
                                    <div class="form-group col-2">
                                        <input type="number" min="0" step="0.01" class="form-control bg-white sub_total" name="amount[]" readonly>
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

                let nhil = +<?php echo getTaxValue('nhil') ?>;
                let gehl = +<?php echo getTaxValue('gehl') ?>;
                let covid19 = +<?php echo getTaxValue('covid19') ?>;
                let vat = +<?php echo getTaxValue('vat') ?>;

                let subTotal = totalAmount + (totalAmount * (nhil / 100)) + (totalAmount * (gehl / 100)) + (totalAmount * (covid19 / 100));

                let total = subTotal + ((subTotal * (vat / 100)));

                // $('.total_amount').val(subTotal);
                $('.total_amount').val(total.toFixed(2));
            }

            $('.getTotalAmount').delegate('.quantity', 'keyup', function(){
                var div = $(this).parent().parent();
                var qty = div.find('.quantity').val() - 0;
                var price = div.find('.price').val() - 0;
                var total = qty * price;
                div.find('.sub_total').val(total.toFixed(2));
                TotalAmount();
            });

            // Checking quantity with stock
            /*$('.getTotalAmount').delegate('.quantity', 'keyup', function(){
                var div = $(this).parent().parent();
                var qty = div.find('.quantity').val() - 0;
                var stock = div.find('.stock').val() - 0;
                if(stock < qty){
                    alert('Quantity Entered is Greater than Quantity in Stock!!');
                    div.find('.quantity').val('');
                    div.find('.quantity').focus;
                }
                else if(qty == 0){
                    alert('Quantity Entered should not be Zero (0)!!');
                    div.find('.quantity').val('');
                    div.find('.quantity').focus;
                }
            }); */

            // delete row and subtract from total amount
            $('.getTotalAmount').delegate('.bottn_delete', 'click', function(){
                var div = $(this).parent().parent();
                var sub_total = div.find('.sub_total').val() - 0;
                var total_amount = $('.total_amount').val() - 0;

                let nhil = +<?php echo getTaxValue('nhil') ?>;
                let gehl = +<?php echo getTaxValue('gehl') ?>;
                let covid19 = +<?php echo getTaxValue('covid19') ?>;
                let vat = +<?php echo getTaxValue('vat') ?>;

                let subTotal = sub_total + (sub_total * (nhil / 100)) + (sub_total * (gehl / 100)) + (sub_total * (covid19 / 100));

                let total = subTotal + ((subTotal * (vat / 100)));

                var new_total = total_amount - total;

                $('.total_amount').val(new_total.toFixed(2));
                //  alert(price);
                 div.remove();
            });

            // Change Calculator
            $("#amount_given").keyup(function(){
                var total = $('.total_amount').val();
                var amount_given = $('#amount_given').val();

                $('#change').val((amount_given - total).toFixed(2));
            });

            // Transaction ID
            $("#electronic").change(function(){
                // $("#transac").css("display","block")
                $("#transaction_id").attr("required", true);
                $("#transaction_id").attr("readonly", false);
            });

            $("#cash").change(function(){
                // $("#transac").css("display","none");
                $("#transaction_id").attr("readonly", true);
            });

            $(".customer").change(function(){
                var cus = $('.customer').val();
                if(cus === 'Add Customer'){
                    $("#displayCustomerInput").css("display","block");
                    $(".cusInput").attr("required", true);
                } else {
                    $("#displayCustomerInput").css("display","none");
                    $(".cusInput").attr("required", false);
                }

            });

            $(document).on('keypress',function(e) {
                // if(('.product').val() != ''){
                    if(e.which == 13) {
                        // alert($('.product').val());
                        e.preventDefault();
                    }
                // }
            });

        };

    </script>
@endpush

@endsection
