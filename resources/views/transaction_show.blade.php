@extends('layout.app')

@section('title', 'POS | View Transaction')

@section('content')
    <div class="container px-3 px-lg-5">
        <article class="resume-wrapper mx-auto theme-bg-light p-2 mb-5 my-5 shadow-lg">
            
            <div class="resume-header">
                <div class="row align-items-center">
                    <div class="resume-title col-12 col-md-6 col-lg-8 col-xl-10">
                        <h2 class="resume-name mb-0 text-uppercase" style="padding-left: 4rem;">View Transaction</h2>
                    </div><!--//resume-title-->
                    <div class="resume-contact col-12 col-md-6 col-lg-4 col-xl-2">
                        @if (Auth()->user()->role == 1)
                            <a href="{{ route('transactions_list') }}" class="btn btn-success">Transactions</a>
                        @else
                            <a href="{{ route('transactions_list_user') }}" class="btn btn-success">Transactions</a>
                        @endif
                       
                    </div><!--//resume-contact-->
                </div><!--//row-->
                
            </div><!--//resume-header-->
            <hr>
            <div class="resume-intro py-3" style="padding: 4rem 4rem;">
    
                <div class="row">
                    <div class="col-md-3">
                        <label for="inputCity" class="form-label">Receipt Number</label>
                        <input type="text" value="{{ $trans->id }}" class="form-control bg-white" id="inputCity" readonly>
                    </div>
                    <div class="col-3">
                        <label for="inputAddress" class="form-label">Payment Method</label>
                        <input type="text" value="{{ $trans->payment_method }}" class="form-control bg-white" id="inputAddress" readonly>
                    </div>
                    <div class="col-3">
                        <label for="inputAddress" class="form-label">Transaction ID</label>
                        <input type="text" value="{{ $trans->payment_transac_no }}" class="form-control bg-white" id="inputAddress" readonly>
                    </div>
                    <div class="col-3">
                        <label for="inputAddress" class="form-label">Transaction Date</label>
                        <input type="date" value="{{ $trans->transac_date }}" class="form-control bg-white" id="inputAddress" readonly>
                    </div>
                </div>
                
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Brand - Product (Description)</th>
                            <th style="text-align: right">Quantity</th>
                            <th style="text-align: right">Unit Price</th>
                            <th style="text-align: right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $transaction as $transaction)
                            <tr>
                                <td>{{ $transaction->product->brand }} - {{ $transaction->product->name }} ({{ $transaction->product->description }})</td>
                                <td style="text-align: right">{{ $transaction->quantity}}</td>
                                <td style="text-align: right">{{ $transaction->unit_price }}</td>
                                <td style="text-align: right">{{ number_format($transaction->amount, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" style="text-align: center">Total</th>
                            <th colspan="2" style="text-align: right">{{ number_format($trans->amount_paid, 2) }}</th>
                        </tr>
                        <tr>
                            <th colspan="2" style="text-align: left">Sales Person</th>
                            <th colspan="2" style="text-align: center">{{ $trans->user->username }}</th>
                        </tr>
                    </tfoot>
                </table>               

            </div><!--//resume-intro-->

            <hr>
            
            <div class="resume-footer text-center" style="margin-bottom: 1rem;">
                @include('layout.footer')
            </div><!--//resume-footer-->
        </article>
        
    </div><!--//container-->

@endsection
