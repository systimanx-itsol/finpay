<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
     <!-- <link rel="icon" href="<%= BASE_URL %>favicon.ico">
    <link rel='icon' href="{{ asset('images/mbglogo.png') }}" type='image/x-icon' sizes="16x16" /> 
   <link rel="icon" href="{{ asset('images/logo.png') }}"> 
     <link rel="icon" sizes="16x16" href="{{ asset('images/logo1.png') }}">  -->
    <!-- <title>asdf</title> -->
      <style>
		* {
                margin:0px;
                padding:5px;
            }
            body {
                color: #000 !important;
            }
            table {
                width:100%;                
            }
            #header table {
                width:100%;
                padding: 0px;
            }
            #header table td, .amount-summary td {                
                vertical-align: text-top;
                padding: 5px;
            }
            .table th, .table td{
                border-top: 0px solid #ddd;
            }
            #company-name{
                color:#000;
                font-size: 18px;
            }
            #invoice-to td {
                text-align: left
            }
            #invoice-to {
                margin-bottom: 15px;
            }
            #invoice-to-right-table td {
                padding-right: 5px;
                padding-left: 5px;
                text-align: right;
            }
            .seperator {
                height: 25px
            }
            .top-border {
                border-top: none;
            }
            .no-bottom-border {
                border:none !important;
                background-color: white !important;
            }
            
           <!-- CSS goes in the document HEAD or added to your external stylesheet -->
            table.gridtable {
                    color:#333333;
                    border-width: 1px;
                    border-color: #666666;
                    border-collapse: collapse;
                    width: 100%;
            }
            table.gridtable th {
                    border-width: 1px;
                    padding: 8px;
                    border-style: solid;
                    border-color: #666666;
                    background-color: #dedede;                    
            }
            table.gridtable td {
                    border-width: 1px;
                    padding: 8px;
                    border-style: solid;
                    border-color: #666666;
                    background-color: #ffffff;
            }
			
			
        
    </style>
</head>
<body>
	<div id="header">
		<table class="table" style="width: 100%">
                <tr>
                    <td id="company-name" style="width: 40%">&nbsp;</td>
                    <td style="width: 15%">&nbsp;</td>
                    <td style="text-align: right; width: 40%">
					<h2>{{ mb_strtoupper(trans('invoice')) }}</h2>
                    </td>

    
              <tr>
                <td id="company-name">
       
                </td>
                <td>&nbsp;</td>
                <td>
                    <strong>{{ mb_strtoupper(trans ($companies->company_name)) }}</strong><br>
                    {{ $companies->address}},<br>
                    {{ $companies->city}}-{{ $companies->zipcode}},<br>
                    {{ $companies->state}},<br>
                    {{ $companies->country}},<br>
                    {{ $companies->website}},<br>
                    {{ $companies->phone}}

                   
                </td>
            </tr>
                <tr>
                    <td>
                        <table class="gridtable">
                            <tr>
                            <th align="left">
                            {{ mb_strtoupper(trans('Bill To')) }}:
                            </th>
                            </tr>
                            <tr>
                                <td>
									{{ $invoice->client_name }},<br>
                                    {{ $invoice->email}},<br>
                                    {{ $invoice->address}},<br>
                                    {{ $invoice->city}}-{{ $invoice->postal_code}},<br>
                                    {{ $invoice->state}},<br>
                                    {{ $invoice->country}},<br>
                                    {{ $invoice->phone_number}}<br>
								
                                 </td>
                            </tr>
                        </table>
                    </td>
                    <td>&nbsp;</td>
                    <td style="padding: 10px;text-align: right;">
                        <table  class="gridtable">
                            <tbody>

                            <tr>
                            <th align="left">{{ trans('Invoice Number') }}: </th>
                                    <td>{{ $invoice->invoice_number }}</td>
                                </tr>
                                <tr>
                                    <th align="left">{{ trans('Date') }}: </th>
                                    <td>{{ $invoice->date }}</td>
                                </tr>
                                <tr>
                                    <th align="left">{{ trans('Expires On') }}: </th>
                                    <td>{{  $invoice->expires_on }}</td>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>
	</div>
    
	<div id="invoice-items" style="width: 98%;padding-top: 5px">
            <table class="gridtable" style="width: 100%;">
                <thead>
                <tr>
             
                <th class="amount" style="text-align: right;">{{ mb_strtoupper(trans('product name')) }}</th>
                        <th class="amount" style="text-align: right;">{{ mb_strtoupper(trans('quantity')) }}</th>
                        <th class="amount" style="text-align: right;">{{ mb_strtoupper(trans('price')) }}</th>
                        <!-- <th class="amount" style="text-align: right;">{{ mb_strtoupper(trans('total')) }}</th> -->
                   </tr>
                </thead>
                <tbody>
              
				
				@foreach($products as $key => $product)
                <tr>

               
                        <td nowrap class="amount" style="text-align: right;">{{ $product->product_name }}</td>
						<td nowrap class="amount" style="text-align: right;">{{ $product->quantity }}</td>
						<td nowrap class="amount" style="text-align: right;">{{$currencyplacement->placement==0 ?  $currencies->symbol : ''}}  {{ number_format($product->price,$currencyplacement->decimal) }} {{$currencyplacement->placement==1 ?  $currencies->symbol : ''}}</td>
					
					</tr>
                    @endforeach

				
                </tbody>
            </table>
			
			<table>
                <tr>
                    <td width="50%">&nbsp;</td>
                    <td style="text-align: right;" width="25%">
                        <table>
                            <tr>
                                <td style="text-align:  right;font-weight: bold;">{{ mb_strtoupper(trans('sub total')) }}</td>
                                <td class="amount" style="text-align: right;">{{$currencyplacement->placement==0 ?  $currencies->symbol : ''}}  {{ number_format($invoiceamounts->item_sub_total,$currencyplacement->decimal) }} {{$currencyplacement->placement==1 ?  $currencies->symbol : ''}}</td>
                            </tr>
							
						
							 <tr>
                                <td style="text-align:  right;font-weight: bold;">{{mb_strtoupper(trans('tax'))}}</td>
                                <td class="amount" style="text-align: right;">{{$currencyplacement->placement==0 ?  $currencies->symbol : ''}} {{ number_format($invoiceamounts->item_tax_total,$currencyplacement->decimal) }} {{$currencyplacement->placement==1 ?  $currencies->symbol : ''}}</td>
                            </tr>
							
                             <tr>
                                <td style="text-align:  right;font-weight: bold;">{{ mb_strtoupper(trans('discount amount')) }}</td>
                                <td class="amount" style="text-align: right;">{{$currencyplacement->placement==0 ?  $currencies->symbol : ''}} {{ number_format($invoiceamounts->discount_amount,$currencyplacement->decimal) }} {{$currencyplacement->placement==1 ?  $currencies->symbol : ''}}</td>
                            </tr>
	
							<tr>    
								<td style="text-align: right;font-weight: bold;">{{ mb_strtoupper(trans('total amount')) }}</td>
								<td class="amount" style="text-align: right;">{{$currencyplacement->placement==0 ?  $currencies->symbol : ''}} {{ number_format($invoiceamounts->total_amount,$currencyplacement->decimal) }} {{$currencyplacement->placement==1 ?  $currencies->symbol : ''}}</td>
							</tr>
							
							<tr>
								<td style="text-align: right;font-weight: bold;">{{ mb_strtoupper(trans('Paid')) }}</td>
								<td class="amount" style="text-align: right;">{{$currencyplacement->placement==0 ?  $currencies->symbol : ''}} {{ number_format($invoice->total_paid_amount,$currencyplacement->decimal) }} {{$currencyplacement->placement==1 ?  $currencies->symbol : ''}}</td>
							</tr> 
							
							<tr>
								<td style="text-align: right;font-weight: bold;">{{ mb_strtoupper(trans('Balance')) }}</td>
								<td class="amount" style="text-align: right;">{{$currencyplacement->placement==0 ?  $currencies->symbol : ''}} {{ number_format($invoice->balance,$currencyplacement->decimal) }} {{$currencyplacement->placement==1 ?  $currencies->symbol : ''}} </td>
							</tr>
                        </table>
                    </td>
                </tr>
            </table>
           
	
	<table class="table" style="width: 100%">
		<tr>
			<td style="width: 40%">&nbsp;
				<table class="gridtable">
					<tr>
						<th align="left">
							Payable To:
						</th>
					</tr>
					<tr>
						<td>
							Account Name: <strong>SYSTIMANX IT SOLUTIONS PRIVATE LIMITED</strong><br>
							Bank Name: IndusInd Bank Bank<br>
							Account No: 201001037518<br>
							Branch: Chinna Chokkikulam, Madurai<br>
							IFSC Code: INDB0000117
						</td>
					</tr>
				</table>				
			</td>
			<td style="width: 15%">&nbsp;</td>
			<td style="width: 40%">&nbsp;</td>
		</tr>
	</table>
	
    <div class="footer" style="text-align:right;"></div> 

</body>
</html> 