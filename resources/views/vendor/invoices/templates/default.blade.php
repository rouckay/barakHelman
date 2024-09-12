<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $invoice->name }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 14px;
            color: #444444;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #fff5e1;
            border: 2px solid #f9c69d;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            color: #4a4a4a;
        }

        .logo {
            font-size: 20px;
            background-color: #d4b5f8;
            padding: 10px 20px;
            border-radius: 50%;
        }

        .title {
            margin-bottom: 20px;
            color: #4a4a4a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        thead th {
            background-color: #f9c69d;
            padding: 10px;
            color: #4a4a4a;
            border: 1px solid #f9c69d;
        }

        tbody td {
            padding: 10px;
            border: 1px solid #f9c69d;
        }

        .footer {
            font-weight: bold;
            color: #4a4a4a;
        }
    </style>

</head>

<body dir="rtl">
    {{-- Header --}}
    @if($invoice->logo)
        <img src="{{ $invoice->getLogo() }}" alt="logo" height="100">
    @endif

    <table class="table mt-5">
        <tbody>
            <tr>
                <td class="pl-0 border-0" width="70%">
                    <h4 class="text-uppercase">
                        <strong>{{ $invoice->name }}</strong>
                    </h4>
                </td>
                <td class="pl-0 border-0">
                    @if($invoice->status)
                        <h4 class="text-uppercase cool-gray">
                            <strong>{{ $invoice->status }}</strong>
                        </h4>
                    @endif
                    <p>{{ __('invoices::invoice.serial') }} <strong>{{ $invoice->getSerialNumber() }}</strong></p>
                    <p>{{ __('invoices::invoice.date') }}: <strong>{{ $invoice->getDate() }}</strong></p>
                </td>
            </tr>
        </tbody>
    </table>

    {{-- Seller - Buyer --}}
    <table class="table">
        <thead>
            <tr>
                <th class="pl-0 border-0 party-header" width="48.5%">
                    {{ __('invoices::invoice.seller') }}
                </th>
                <th class="border-0" width="3%"></th>
                <th class="pl-0 border-0 party-header">
                    {{ __('invoices::invoice.buyer') }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="px-0">
                    @if($invoice->seller->name)
                        <p class="seller-name">
                            <strong>{{ $invoice->seller->name }}</strong>
                        </p>
                    @endif

                    @if($invoice->seller->address)
                        <p class="seller-address">
                            {{ __('invoices::invoice.address') }}: {{ $invoice->seller->address }}
                        </p>
                    @endif

                    @if($invoice->seller->phone)
                        <p class="seller-phone">
                            {{ __('invoices::invoice.phone') }}: {{ $invoice->seller->phone }}
                        </p>
                    @endif

                    @foreach($invoice->seller->custom_fields as $key => $value)
                        <p class="seller-custom-field">
                            {{ ucfirst($key) }}: {{ $value }}
                        </p>
                    @endforeach
                </td>
                <td class="border-0"></td>
                <td class="px-0">
                    @if($invoice->buyer->name)
                        <p class="buyer-name">
                            <strong>{{ $invoice->buyer->name }}</strong>
                        </p>
                    @endif

                    @if($invoice->buyer->address)
                        <p class="buyer-address">
                            {{ __('invoices::invoice.address') }}: {{ $invoice->buyer->address }}
                        </p>
                    @endif

                    @if($invoice->buyer->code)
                        <p class="buyer-code">
                            {{ __('invoices::invoice.code') }}: {{ $invoice->buyer->code }}
                        </p>
                    @endif

                    @if($invoice->buyer->vat)
                        <p class="buyer-vat">
                            {{ __('invoices::invoice.vat') }}: {{ $invoice->buyer->vat }}
                        </p>
                    @endif

                    @if($invoice->buyer->phone)
                        <p class="buyer-phone">
                            {{ __('invoices::invoice.phone') }}: {{ $invoice->buyer->phone }}
                        </p>
                    @endif

                    @foreach($invoice->buyer->custom_fields as $key => $value)
                        <p class="buyer-custom-field">
                            {{ ucfirst($key) }}: {{ $value }}
                        </p>
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>

    {{-- Table --}}
    <table class="table table-items">
        <thead>
            <tr>
                <th scope="col" class="pl-0 border-0">{{ __('invoices::invoice.description') }}</th>
                @if($invoice->hasItemUnits)
                    <th scope="col" class="text-center border-0">{{ __('invoices::invoice.units') }}</th>
                @endif
                <th scope="col" class="text-center border-0">{{ __('invoices::invoice.quantity') }}</th>
                <th scope="col" class="text-right border-0">{{ __('invoices::invoice.price') }}</th>
                @if($invoice->hasItemDiscount)
                    <th scope="col" class="text-right border-0">{{ __('invoices::invoice.discount') }}</th>
                @endif
                @if($invoice->hasItemTax)
                    <th scope="col" class="text-right border-0">{{ __('invoices::invoice.tax') }}</th>
                @endif
                <th scope="col" class="pr-0 text-right border-0">{{ __('invoices::invoice.sub_total') }}</th>
            </tr>
        </thead>
        <tbody>
            {{-- Items --}}
            @foreach($invoice->items as $item)
                <tr>
                    <td class="pl-0">
                        {{ $item->title }}

                        @if($item->description)
                            <p class="cool-gray">{{ $item->description }}</p>
                        @endif
                    </td>
                    @if($invoice->hasItemUnits)
                        <td class="text-center">{{ $item->units }}</td>
                    @endif
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">
                        {{ $invoice->formatCurrency($item->price_per_unit) }}
                    </td>
                    @if($invoice->hasItemDiscount)
                        <td class="text-right">
                            {{ $invoice->formatCurrency($item->discount) }}
                        </td>
                    @endif
                    @if($invoice->hasItemTax)
                        <td class="text-right">
                            {{ $invoice->formatCurrency($item->tax) }}
                        </td>
                    @endif

                    <td class="pr-0 text-right">
                        {{ $invoice->formatCurrency($item->sub_total_price) }}
                    </td>
                </tr>
            @endforeach
            {{-- Summary --}}
            @if($invoice->hasItemOrInvoiceDiscount())
                <tr>
                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                    <td class="pl-0 text-right">{{ __('invoices::invoice.total_discount') }}</td>
                    <td class="pr-0 text-right">
                        {{ $invoice->formatCurrency($invoice->total_discount) }}
                    </td>
                </tr>
            @endif
            @if($invoice->taxable_amount)
                <tr>
                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                    <td class="pl-0 text-right">{{ __('invoices::invoice.taxable_amount') }}</td>
                    <td class="pr-0 text-right">
                        {{ $invoice->formatCurrency($invoice->taxable_amount) }}
                    </td>
                </tr>
            @endif
            @if($invoice->tax_rate)
                <tr>
                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                    <td class="pl-0 text-right">{{ __('invoices::invoice.tax_rate') }}</td>
                    <td class="pr-0 text-right">
                        {{ $invoice->tax_rate }}%
                    </td>
                </tr>
            @endif
            @if($invoice->hasItemOrInvoiceTax())
                <tr>
                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                    <td class="pl-0 text-right">{{ __('invoices::invoice.total_taxes') }}</td>
                    <td class="pr-0 text-right">
                        {{ $invoice->formatCurrency($invoice->total_taxes) }}
                    </td>
                </tr>
            @endif
            @if($invoice->shipping_amount)
                <tr>
                    <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                    <td class="pl-0 text-right">{{ __('invoices::invoice.shipping') }}</td>
                    <td class="pr-0 text-right">
                        {{ $invoice->formatCurrency($invoice->shipping_amount) }}
                    </td>
                </tr>
            @endif
            <tr>
                <td colspan="{{ $invoice->table_columns - 2 }}" class="border-0"></td>
                <td class="pl-0 text-right">{{ __('invoices::invoice.total_amount') }}</td>
                <td class="pr-0 text-right total-amount">
                    {{ $invoice->formatCurrency($invoice->total_amount) }}
                </td>
            </tr>
        </tbody>
    </table>

    @if($invoice->notes)
        <p>
            {{ __('invoices::invoice.notes') }}: {!! $invoice->notes !!}
        </p>
    @endif

    <p>
        {{ __('invoices::invoice.amount_in_words') }}: {{ $invoice->getTotalAmountInWords() }}
    </p>
    <p>
        {{ __('invoices::invoice.pay_until') }}: {{ $invoice->getPayUntilDate() }}
    </p>

    <script type="text/php">
        if (isset($pdf)) {
            $pdf->page_text(270, 780, "{{ __('invoices::invoice.page') }}: {PAGE_NUM} / {PAGE_COUNT}", null, 10, array(0,0,0));
        }
    </script>
</body>


</html>