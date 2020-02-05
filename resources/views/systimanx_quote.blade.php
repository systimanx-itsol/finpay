<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- <title>asdf</title> -->
    <style>
        * {
            margin: 0px;
            padding: 5px;
        }

        body {
            color: #000 !important;
        }

        table {
            width: 100%;
        }

        #header table {
            width: 100%;
            padding: 0px;
        }

        #header table td,
        .amount-summary td {
            vertical-align: text-top;
            padding: 5px;
        }

        .table th,
        .table td {
            border-top: 0px solid #ddd;
        }

        #company-name {
            color: #000;
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
            border: none !important;
            background-color: white !important;
        }

        < !-- CSS goes in the document HEAD or added to your external stylesheet -->table.gridtable {
            color: #333333;
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
                    <h2>{{ mb_strtoupper(trans('Quotation')) }}</h2>
                </td>
            </tr>

            <tr>
                <td id="company-name">

                </td>
                <td>&nbsp;</td>
                <td>
                    <strong>{{ $Company->company_name }}</strong><br>
                    {{ $Company->address}}<br>
                    {{ $Company->city}}-{{ $Company->zipcode}}<br>
                    {{ $Company->state}},{{ $Company->country}}<br>
                    {{ $Company->phone}}<br>
                </td>
            </tr>
            <!-- <tr> -->


            <!-- <td>&nbsp;</td>
                    <td>
                    <strong>SYSTIMANX IT SOLUTIONS PRIVATE LIMITED</strong><br>
							Plot No.22, Door no:37 Sri Venkata<br>
							subaramaniam nagar 1st main road<br>
							valasaravakam<br>
							chennai,Tamilnadu 600 087<br>
                    </td> -->
            <!-- </tr> -->
            <td>
                <table class="gridtable">
                    <tr>
                        <th align="left">
                            {{ mb_strtoupper(trans('bill to')) }}:
                        </th>
                    </tr>
                    <tr>
                        <td>
                            {{ $Client->client_name }}<br>
                            {{ $Client->email}}<br>
                            {{ $Client->address}}<br>
                            {{ $Client->phone_number}}<br>

                        </td>
                    </tr>
                </table>
            </td>
            <td>&nbsp;</td>
            <td style="padding: 10px;text-align: right;">
                <table class="gridtable">
                    <tbody>

                        <tr>
                            <th align="left">{{ trans('quote no') }}: </th>
                            <td>{{ $details->quote_no }}</td>
                        </tr>
                        <tr>
                            <th align="left">{{ trans('date') }}: </th>
                            <td>{{ $details->date }}</td>
                        </tr>
                        <tr>
                            <th align="left">{{ trans('expires on') }}: </th>
                            <td>{{ $details->expires_on }}</td>
                        </tr>

                    </tbody>
                </table>
            </td>
            </tr>
        </table>
    </div>

    <div id="quotes-items" style="width: 98%;padding-top: 5px">
        <table class="gridtable" style="width: 100%;">
            <thead>
                <tr>


                    <th class="amount" style="text-align: right;">{{ mb_strtoupper(trans('product name')) }}</th>
                    <th class="amount" style="text-align: right;">{{ mb_strtoupper(trans('quantity')) }}</th>
                    <th class="amount" style="text-align: right;">{{ mb_strtoupper(trans('price')) }}</th>
                    <!-- <th class="amount" style="text-align: right;">{{ mb_strtoupper(trans('total')) }}</th>  -->
                </tr>
            </thead>
            <tbody>
                @foreach ($quotes as $quotes)
                <tr>

                    <td nowrap class="amount" style="text-align: right;">{{ $quotes->product_name }}</td>
                    <td nowrap class="amount" style="text-align: right;">{{ $quotes->quantity }}</td>
                    <td nowrap class="amount" style="text-align: right;">{{ $currency->symbol }}{{ $quotes->price }}</td>
                    <!-- <td nowrap class="amount" style="text-align: right;">{{ $quotes->total }}</td> -->
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
                            <td style="text-align: right;font-weight: bold;">{{ trans('Tax before total') }}</td>
                            <td class="amount" style="text-align: right;">{{ $quotes_item_amount->tax_before_total }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;font-weight: bold;">{{ trans('Discount') }}</td>
                            <td class="amount" style="text-align: right;">{{ $quotes_item_amount->discount }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;font-weight: bold;">{{ trans('Tax') }}</td>
                            <td class="amount" style="text-align: right;">{{ $quotes_item_amount->tax}}</td>
                        </tr>

                        <tr>
                            <td style="text-align: right;font-weight: bold;">{{ trans('Total amount') }}</td>
                            <td class="amount" style="text-align: right;">{{ $quotes_item_amount->total_amount}}</td>
                        </tr>




                    </table>
                </td>
            </tr>
        </table>



        <table class="table" style="width: 100%">
            <tr>
                <td style="width: 40%">&nbsp;

                </td>
                <td style="width: 15%">&nbsp;</td>
                <td style="width: 40%">&nbsp;</td>
            </tr>
        </table>

        <div class="footer" style="text-align:right;"></div>

</body>

</html>