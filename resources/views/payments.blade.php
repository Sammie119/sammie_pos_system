@extends('layout.app')

@section('title', 'POS | Payments')

@section('content')
    <div class="container px-3 px-lg-5">
        <article class="resume-wrapper mx-auto theme-bg-light p-2 mb-5 my-5 shadow-lg">

            <div class="resume-header">
                <div class="row align-items-center">
                    <div class="resume-title col-12 col-md-6 col-lg-8 col-xl-10">
                        <h2 class="resume-name mb-0 text-uppercase" style="padding-left: 4rem;">Enter Payment</h2>
                    </div><!--//resume-title-->
                    <div class="resume-contact col-12 col-md-6 col-lg-4 col-xl-2">
                        <a href="{{ route('payments_list') }}" class="btn btn-success">Payment</a>
                    </div><!--//resume-contact-->
                </div><!--//row-->

            </div><!--//resume-header-->
            <hr>
            <div class="resume-intro py-3" style="padding: 4rem 4rem;">
                <form action="{{ route('store_payment') }}" method="POST" autocomplete="off" class="row g-3">
                    @csrf

                    @include('forms.payment_form')

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
            $("body").on("click",".addInvoice", function (){
                var invoice = $('.invoice').val();
                if(invoice === ''){
                    alert('Invoice Input Empty!!!');
                }else {
                    $.ajax({
                    type:'GET',
                    url:"search_invoice",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        invoice
                        },
                    success:function(data) {
                        if(data.invoice === 'No_data'){
                            alert('Invoice does not Exist!!!');
                        }else{
                            data.data.forEach(data => {
                                document.querySelector('#contentInvoice').insertAdjacentHTML(
                                    'beforeend',
                                    `<div class="row mb-2">
                                        <div class="form-group col-5">
                                            <select class="form-control bg-white" name="product_id[]"><option value="${data.product_id}" selected>${data.product.name}</option></select>
                                        </div>
                                        <div class="form-group col-2">
                                            <input type="number" min="0" step="1" class="form-control bg-white" style="text-align: right" name="rate[]" value="${data.unit_price}" readonly>
                                        </div>
                                        <div class="form-group col-2">
                                            <input type="number" min="0" step="1" class="form-control bg-white" style="text-align: right" name="quantity[]" value="${data.quantity}" readonly>
                                        </div>
                                        <div class="form-group col-3">
                                            <input type="number" min="0" step="0.01" class="form-control bg-white sub_total" style="text-align: right" name="amount[]" value="${data.amount}" readonly>
                                        </div>
                                    </div>`
                                );
                            });
                        }

                        document.querySelector('.show_data').style.display='none';

                        if(data.invoice === 'data'){
                            // $('.invoice').val('');
                            $(".invoice").attr("readonly", true);
                            $(".total_amount").val(data.taxed_amount);
                            $(".paid").val(data.amount_paid);
                            $(".tax").val(data.tax.toFixed(2));
                            // $('.invoice').focus();
                        }

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

            $(".amount_paid").change(function(){
                let get_amount = $('.total_amount').val();

                if(get_amount == 0.00){
                    alert("Total Amount is Empty");
                    $('.amount_paid').val('');
                } else {
                    let total_amount = $('.total_amount').val()  - 0;
                    let amount_paid = $('.amount_paid').val()  - 0;
                    let paid = $('.paid').val() - 0;

                    $('.balance').val((total_amount - (amount_paid + paid)).toFixed(2));
                }
            });

            $("form").submit(function(){
                let get_amount = $('.amount_paid').val();

                if(get_amount == 0.00){
                    alert("Amount Paid is Empty");
                    $('.amount_paid').focus();
                    return false;
                }
            });
        };

    </script>
@endpush

@endsection
