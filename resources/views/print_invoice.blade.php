<link id="theme-style" rel="stylesheet" href="{{ asset('/assets/css/devresume.css') }}">

<head>
	<title>Receipt</title>
	<style type="text/css">
		body{
			width: 750px;
            font-size: 13px;
		}

		table {
            font-size: 13px;
        }
		tfoot {
			border-top: solid thin;
			border-bottom: solid thin;
		}

        th {
            font-weight: normal;
            padding-top: 5px;
            padding-bottom: 5px;
        }

		hr {
			border-color: #000;
		}

        .mov-right {
            text-align: right
        }

		button {
		   float: right;
		   padding: 10px 25px;

		  font-family: 'Bree Serif', serif;
		  font-weight: 200;
		  font-size: 18px;
		  color: #fff;
		  text-shadow: 0px 1px 0 rgba(0,0,0,0.25);

		  background: #56c2e1;
		  border: 1px solid #46b3d3;
		  border-top-left-radius: 20px;
		  border-bottom-right-radius: 20px;
		  cursor: pointer;

		  box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
		  -moz-box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
		  -webkit-box-shadow: inset 0 0 2px rgba(256,256,256,0.75);
		}

		button:hover{
		  background: #3f9db8;
		  border: 1px solid rgba(256,256,256,0.75);
		  border-top-right-radius: 20px;
		  border-bottom-left-radius: 20px;

		  box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
		  -moz-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
		  -webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,0.5);
		}

		@media print {
			.noprint{
				visibility: hidden;
			}
		}
	</style>

	<script type="text/javascript">
	function print_1(){
		window.print();
		//window.print();
		window.close();
	}

	</script>
</head>
<body id="breaker">
	<div id = "main">
        <div class="row">
            <div class="col-6">
                <img src="{{ asset('/storage/'.getShopSettings()->text_logo) }}" alt="logo" width="150">
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-12"><h1 style="float: right; font-size: 3rem">Invoice</h1></div>
                    <div class="col-12"><h5 style="float: right"># {{ $invoice->first()->invoice_no}}</h5></div>
                </div>
            </div>
        </div>
        <br>
		<!--<div id = "logo"  class = "mov"><img src = "../js/img/img_logo2.png"/></div>-->
		<div>
            @php
                $shop = getShopSettings();

                $invoiceTrans = \App\Models\Invoice::where('id', $invoice->first()->invoice_no)->first();

                $customer = getCustomer($invoiceTrans->customer_id);
            @endphp
			<div><b>{{ $shop->shop_name }}</b><br>
				{{ $shop->address }} <br>
                {{ $shop->phone2 }} <br>
			    {{ $shop->phone1 }} <br>
                {{ $shop->email }}
			</div>
		</div>
        <br>
        <div>
            <label>Bill To</label>
            <label style="float: right">Date {{ date('Y-m-d') }}</label>

			<div><b>{{ $customer->name }}</b><br>
				{{ $customer->address }} <br>
                {{ $customer->location }} <br>
			    {{ $customer->phone }} <br>
                {{ $customer->email }}
			</div>
		</div>

        <br>
		{{-- <hr class = "mov"> --}}

		{{-- <div class = "mov">
			<div><b>Receipt No.:</b>
				<div style="float: right"><b>Pay Mode:</b> {{ \App\Models\Invoice::select('payment_method')->where('id', $invoice->first()->invoice_no)->first()->payment_method }}</div>
			</div>
		</div> --}}

		<div class = "mov">
			{{-- <div align = "center"><u><b>Your Bill</b></u></div> --}}
			<div>
				<table border = "0" class = "mov" width="100%">
					<thead>
                        <tr style="background: #002E69; color: #fff;">
                            <th width = "3%" style="padding: 10px;">#</th>
                            <th width = "60%">Description</th>
                            <th width = "7%" STYLE = "text-align: center;">Qty</th>
                            <th width = "10%" class="mov-right">Rate</th>
                            <th width = "20%" class="mov-right" style="padding: 10px;">Amt</th>
                        </tr>
					</thead>
					<tbody>
						@foreach ($invoice as $key => $trans )
                            @php
                                $product = \App\Models\Product::where('id', $trans->product_id)->first();
                            @endphp
							<tr>
								<td style="padding-left: 10px; padding-top: 5px">{{ ++$key }}.</td>
								<td STYLE = "text-align: left; padding-left: 3px;">{{ $product->brand  }} - {{  $product->name }}</td>
                                <td STYLE = "text-align: center;">{{ $trans->quantity }}</td>
                                <td STYLE = "text-align: right;">{{  $product->price }}</td>
								<td STYLE = "text-align: right; padding-right: 10px; padding-top: 5px">{{ $trans->amount }}</td>
							</tr>
						@endforeach
					</tbody>
                    @if($invoiceTrans->payment_method === "taxable")
                        <tfoot>
                            <tr>
                                <th class="mov-right" colspan = "4">Total: GH&cent;</th>
                                <th class="mov-right" style="padding-right: 10px;" >{{ $amount = $invoiceTrans->transac_amount }}</th>
                            </tr>
                            <tr>
                                <th class="mov-right" colspan = "4" >NHIL({{ $shop->nhil }}%): GH&cent;</th>
                                <th class="mov-right" style="padding-right: 10px;">{{ $nhil = $amount * ($shop->nhil/100) }}</th>
                            </tr>
                            <tr>
                                <th class="mov-right" colspan = "4" >GEHL({{ $shop->gehl }}%): GH&cent;</th>
                                <th class="mov-right" style="padding-right: 10px;">{{ $gehl = $amount * ($shop->gehl/100) }}</th>
                            </tr>
                            <tr>
                                <th class="mov-right" colspan = "4" >CoVID-19({{ $shop->covid19 }}%): GH&cent;</th>
                                <th class="mov-right" style="padding-right: 10px;">{{ $covid = $amount * ($shop->covid19/100) }}</th>
                            </tr>
                            <tr  style="background: #C6C6C6;">
                                <th class="mov-right" colspan = "4" >Sub Total: GH&cent;</th>
                                <th class="mov-right" style="padding-right: 10px;">{{ $sub_total = $amount + $nhil + $gehl + $covid }}</th>
                            </tr>
                            <tr>
                                <th class="mov-right" colspan = "4" >VAT({{ $shop->vat }}%): GH&cent;</th>
                                <th class="mov-right" style="padding-right: 10px;">{{ $vat = $sub_total * ($shop->vat/100) }}</th>
                            </tr>
                            <tr  style="background: #C6C6C6;">
                                <th class="mov-right" colspan = "4" >Grand Total: GH&cent;</th>
                                <th class="mov-right" style="padding-right: 10px;">{{ $sub_total + $vat }}</th>
                            </tr>

                        </tfoot>
                    </table>
                @else
                    <tfoot>
                        <tr>
                            <th class="mov-right" colspan = "4">Total: GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px;">{{ $amount = $invoiceTrans->transac_amount }}</th>
                        </tr>
                        <tr>
                            <th class="mov-right" colspan = "4" >Tax: GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px;">0.00</th>
                        </tr>

                        <tr  style="background: #C6C6C6;">
                            <th class="mov-right" colspan = "4" >Sub Total: GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px;">{{ $amount }}</th>
                        </tr>

                        <tr style="background: #C6C6C6;">
                            <th class="mov-right" colspan = "4" style="color: black">Grand Total: GH&cent;</th>
                            <th class="mov-right" style="padding-right: 10px;">{{ $amount }}</th>
                        </tr>

                    </tfoot>
                @endif
            </table>

			</div>
			{{-- Cashier: {{ get_user(\App\Models\Invoice::select('user_id')->where('id', $invoice->first()->invoice_no)->first()->user_id) }} --}}
		</div>
		{{-- <div align = "center"><b>Stay Blessed.......</b></div> --}}

	</div>
	{{-- <div align = "center"><b><i>Created and Designed by: Sammav IT Consult <br> 0248376160/0556226864</i></b></div> --}}
	<div class = "mov noprint">
		<button onClick = "print_1()">Print</button>
	</div>
</body>

{{-- <script type="text/javascript">
	window.onload = function(){
		document.getElementById("breaker").style.pageBreakAfter = "always";
	};
</script> --}}
