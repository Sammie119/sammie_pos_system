@extends('layout.app')

@section('title', 'POS | Income & Expenditure')

@section('content')
    <div class="container px-3 px-lg-5">
        <article class="resume-wrapper mx-auto theme-bg-light p-2 mb-5 my-5 shadow-lg">

            <div class="resume-header">
                <div class="row align-items-center">
                    <div class="resume-title col-12 col-md-6 col-lg-8 col-xl-10">
                        <h2 class="resume-name mb-0 text-uppercase" style="padding-left: 4rem;">Enter Income or Expenditure</h2>
                    </div><!--//resume-title-->
                    <div class="resume-contact col-12 col-md-6 col-lg-4 col-xl-2">
                        <a href="{{ route('income_exp_list') }}" class="btn btn-success">Income & Exp</a>
                    </div><!--//resume-contact-->
                </div><!--//row-->
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="text-danger">{{$error}}</div>
                    @endforeach
                @endif
            </div><!--//resume-header-->
            <hr>
            <div class="resume-intro py-3" style="padding: 4rem 4rem;">
                <form action="{{ route('income_exp') }}" method="POST" autocomplete="off" class="row g-3">
                    @csrf

                    @include('forms.income_form')

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

                document.querySelector('#contentProduct').insertAdjacentHTML(
                    'beforeend',
                    `<div class="row mb-2">
                        <div class="form-group col-4">
                            <input type="text" class="form-control bg-white" name="transaction_name[]" required>
                        </div>
                        <div class="form-group col-2">
                            <select class="form-control bg-white" name="transaction_type[]" required>
                                <option disabled>--Select--</option>
                                <option>Income</option>
                                <option>Expenditure</option>
                            </select>
                        </div>
                        <div class="form-group col-2">
                            <input type="number" min="0" step="0.1" class="form-control bg-white" name="transaction_amount[]" placeholder="0.00" required>
                        </div>
                        <div class="form-group col-2">
                            <input type="date" name="transaction_date[]" max="<?php echo date('Y-m-d')?>" step="0.01" class="form-control bg-white"  name="amount[]" required>
                        </div>
                        <div class="form-group col-1">
                            <input type="button" class="form-control btn btn-success addProduct" value="Add">
                        </div>
                        <div class="form-group col-1">
                            <input type="button" class="btn btn-danger btn-sm bottn_delete" value="Del">
                        </div>
                    </div>`
                );
            });

            // delete row and subtract from total amount
            $('.getTotalAmount').delegate('.bottn_delete', 'click', function(){
                var div = $(this).parent().parent();

                 div.remove();
            });
        };

    </script>
@endpush

@endsection
