<head>
	<title>Receipt</title>
	<style type="text/css">
		body{
			width: 350px;
		}

		table { border-collapse: collapse; }
		th {
			border-top: solid thin; 
			border-bottom: solid thin;
		}

		#main {
			border: solid 1px;
			border-radius: 10px;
		}

		#logo img{
			width: 70px;
			height: 50px;
			float: left;	
		}

		.mov {
			margin: 5px;
			text-transform: uppercase;
		}

		hr {
			border-color: #000;
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
		@php
			$phone2 = \App\Models\ShopSettings::select('phone2')->first()->phone2;
		@endphp
		<!--<div id = "logo"  class = "mov"><img src = "../js/img/img_logo2.png"/></div>-->
		<div>
			<div align = "center" style="text-transform: uppercase"><b>{{ \App\Models\ShopSettings::select('shop_name')->first()->shop_name }}<br>
				{{ \App\Models\ShopSettings::select('address')->first()->address }} <br>
			Mobile No.: {{ \App\Models\ShopSettings::select('phone1')->first()->phone1 }} {{ (empty($phone2)) ? '' : ' / '.$phone2 }}</b>
			</div>
		</div>

		<hr class = "mov">
		
		<div class = "mov">
			<div><b>Receipt No.:</b> {{ $transaction->first()->receipt_no}}
				<div style="float: right"><b>Pay Mode:</b> {{ \App\Models\Transaction::select('payment_method')->where('id', $transaction->first()->receipt_no)->first()->payment_method }}</div>
			</div>
		</div>

		<hr class = "mov">

		<div class = "mov">
			<div align = "center"><u><b>Your Bill</b></u></div>
			<div>
				<table border = "0" class = "mov">
					<thead>
						<th width = "3%">#</th>
						<th width = "">Description</th>
						<th width = "1%">Qty</th>
						<th width = "1%">Amt</th>
					</thead>
					<tbody>
						@foreach ($transaction as $key => $trans )
							<tr>
								<td>{{ ++$key }}.</td>
								<td STYLE = "text-align: left; padding-left: 3px;">{{  \App\Models\Product::select('brand')->where('id', $trans->product_id)->first()->brand }} - {{  \App\Models\Product::select('name')->where('id', $trans->product_id)->first()->name }}</td>
								<td STYLE = "text-align: center;">{{ $trans->quantity }}</td>
								<td STYLE = "text-align: center;">{{ $trans->amount }}</td>
							</tr>
						@endforeach		
					</tbody>
					<tfoot>
						<th colspan = "3">Total Amount: GH&cent;</th>
						<th>{{ \App\Models\Transaction::select('amount_paid')->where('id', $transaction->first()->receipt_no)->first()->amount_paid }}</th>
					</tfoot>
				</table>
			</div>
			Cashier: {{ \App\Models\User::select('name')->where('id', \App\Models\Transaction::select('user_id')->where('id', $transaction->first()->receipt_no)->first()->user_id)->first()->name }}
		</div>
		
		<div align = "center"><b>Stay Blessed.......</b></div>

	</div>
	<div align = "center"><b><i>Created and Designed by: Sammav IT Consult <br> 0248376160/0556226864</i></b></div>
	<div class = "mov noprint">
		<button onClick = "print_1()">Print</button>
	</div>
</body>

<script type="text/javascript">
	window.onload = function(){
		document.getElementById("breaker").style.pageBreakAfter = "always";
	};
</script>
