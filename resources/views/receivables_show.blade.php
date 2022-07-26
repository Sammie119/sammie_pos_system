@extends('layout.app')

@section('title', 'POS | View Receivables')

@section('content')
    <div class="container px-3 px-lg-5">
        <article class="resume-wrapper mx-auto theme-bg-light p-2 mb-5 my-5 shadow-lg">
            
            <div class="resume-header">
                <div class="row align-items-center">
                    <div class="resume-title col-12 col-md-6 col-lg-8 col-xl-10">
                        <h2 class="resume-name mb-0 text-uppercase" style="padding-left: 4rem;">View Receivables</h2>
                    </div><!--//resume-title-->
                    <div class="resume-contact col-12 col-md-6 col-lg-4 col-xl-2">
                        <a href="{{ route('receivables_list') }}" class="btn btn-success">Receivables</a>
                    </div><!--//resume-contact-->
                </div><!--//row-->
                
            </div><!--//resume-header-->
            <hr>
            <div class="resume-intro py-3" style="padding: 4rem 4rem;">
                <div class="col-12 mb-4">
                    <label for="inputAddress" class="form-label">Supplier's Name</label>
                    <select name="supplier_id" class="form-control" id="inputAddress">
                        <option>{{ \App\Models\Supplier::select('name')->where('id', $receivable->supplier_id)->first()->name }}</option>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label for="inputCity" class="form-label">Invoice/Receipt Number</label>
                        <input type="text" value="{{ $receivable->invoice_no }}" class="form-control bg-white" id="inputCity" readonly>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress" class="form-label">received_date</label>
                        <input type="date" value="{{ $receivable->received_date }}" class="form-control bg-white" id="inputAddress" readonly>
                    </div>
                </div>

                @php
                    $product_id = json_decode($receivable->product_id, TRUE);                    
                    $quantity = json_decode($receivable->quantity, TRUE); 
                    $amount = json_decode($receivable->amount, TRUE); 
                @endphp
                
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Brand - Product (Description)</th>
                            <th>Quantity</th>
                            <th style="text-align: right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($x = 0; $x < count($product_id); $x++)
                        @php
                            $product = \App\Models\Product::find($product_id[$x])
                        @endphp
                            <tr>
                                <td>{{ $product->code}}</td>
                                <td>{{ $product->brand }} - {{ $product->name }} ({{ $product->description }})</td>
                                <td>{{ $quantity[$x] }}</td>
                                <td style="text-align: right">{{ number_format($amount[$x], 2) }}</td>
                            </tr>
                        @endfor
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" style="text-align: center">Total</th>
                            <th colspan="2" style="text-align: right">{{ number_format($receivable->total_amount, 2) }}</th>
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
