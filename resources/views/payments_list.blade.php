@extends('layout.app')

@section('title', 'POS | Payments')

@section('content')
    <div class="container-fluid px-3 px-lg-5">
        <article class="resume-wrapper mx-auto theme-bg-light p-3 mb-5 my-5 shadow-lg">

            <div class="resume-header">
                <div class="row align-items-center">
                    <div class="resume-title col-12 col-md-6 col-lg-8 col-xl-10">
                        <h2 class="resume-name mb-0 text-uppercase" style="padding-left: 2rem;">Payments List</h2>
                    </div><!--//resume-title-->
                    <div class="resume-contact col-12 col-md-6 col-lg-4 col-xl-2">
                        <a href="{{ route('add_payment') }}" class="btn btn-success">Add Payment</a>
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
                                <th>Receipt#</th>
                                <th>Invoice#</th>
                                <th>Trans. Amount</th>
                                <th>Amount Paid</th>
                                <th>Balance</th>
                                <th>Mode</th>
                                <th>Trans. Date</th>
                                <th>Status</th>
                                <th>User</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($trans as $key => $tran)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $tran->id }}</td>
                                    <td>{{ $tran->invoice_no }}</td>
                                    <td>{{ number_format($tran->transac_amount, 2) }}</td>
                                    <td>{{ number_format($tran->amount_paid, 2) }}</td>
                                    <td>{{ number_format($tran->balance, 2) }}</td>
                                    <td>{{ $tran->payment_method }}</td>
                                    <td>{{ $tran->transac_date }}</td>
                                    <td>
                                        @if ($tran->balance == 0.00)
                                            Paid
                                        @else
                                            Paying
                                        @endif
                                    </td>
                                    <td>{{ $tran->user->username }}</td>
                                    <td>
                                        @if (Auth()->user()->role == 1)
                                            <a class="btn btn-success" onclick="return window.open('print_receipt/{{ $tran->id }}','','left=0,top=0,width=850,height=477,toolbar=0,scrollbars=0,status =0')" style="padding: 0 7px 0 7px; height: 28px;"><i class="fas fa-print"></i></a>
                                            {{-- <a class="btn btn-info" href="show_transaction/{{ $tran->id }}" title="View" style="padding: 0 7px 0 7px; height: 28px;"><i class="fas fa-eye"></i></a> --}}
                                            <a class="btn btn-danger" onclick="return confirm('This Record will be deleted permanently!!!')" href="delete_transaction/{{ $tran->id }}" title="Delete" style="padding: 0 7px 0 7px; height: 28px;"><i class="fas fa-user-times"></i></a>
                                        @else
                                            <a class="btn btn-success" onclick="return window.open('print_receipt/{{ $tran->id }}','','left=0,top=0,width=850,height=477,toolbar=0,scrollbars=0,status =0')" style="padding: 0 7px 0 7px; height: 28px;"><i class="fas fa-print"></i></a>
                                            {{-- <a class="btn btn-info" href="show_transaction_user/{{ $tran->id }}" title="View" style="padding: 0 7px 0 7px; height: 28px;"><i class="fas fa-eye"></i></a> --}}
                                        @endif
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
