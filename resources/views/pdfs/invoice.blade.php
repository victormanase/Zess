<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body style="padding: 80px">
    <style>
        .text-right {
            text-align: right;
        }
        .table{
            width: 100%;
        }
    </style>
    <table class="table table-borderless">
        <tr>
            <td>
                <img src="{{ asset('logo.png') }}" alt="" style="width: 150px">
            </td>
            <td style="text-align: right">
                <span>Zess Expat Services,</span> <br>
                <span>Zanzibar,</span> <br>
                <span>Tanzania</span> <br>
            </td>
        </tr>
        <tr>
            <td>
                <h5>Invoice to:</h5>
                <span>{{ $consultation->patient->name }},</span> <br>
                <span>{{ $consultation->patient->phone }},</span> <br>
                <span>{{ $consultation->patient->address }}</span> <br>
            </td>
            <td style="text-align: right">
                <h5>INVOICE</h5> <br>
                <span>INVOICE NO: {{ $consultation->invoice_no }},</span> <br>
                <span>DATE: {{ $consultation->created_at->format('d/m/Y') }},</span> <br>
            </td>
        </tr>
        <tr>
            <table class="table table-bordered">
                <tr>
                    <th>S/No</th>
                    <th>Description</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Unit Cost</th>
                    <th class="text-right">Total</th>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>{{ $consultation->service->description }}</td>
                    <td class="text-right">1</td>
                    <td class="text-right">{{ money($consultation->service->price) }}</td>
                    <td class="text-right">{{ money($consultation->service->price) }}</td>
                </tr>
                <tr>
                    <th colspan="4" class="text-right">Total: </th>
                    <th class="text-right">{{ money($consultation->service->price) }}</th>
                </tr>
            </table>
        </tr>

    </table>
</body>

</html>
