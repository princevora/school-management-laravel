<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice For Student</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }
        h1,h2,h3,h4,h5,h6,p,span,label {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }
        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }
        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }
        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }
        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }
        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }
        .text-end {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }
        .no-border {
            border: 1px solid #fff !important;
        }
        .bg-blue {
            background-color: #414ab1;
            color: #fff;
        }
    </style>
</head>
<body>

    <table class="order-details">
        <thead>
            <tr class="bg-blue">
                <th width="50%" colspan="2">Order Details</th>
                <th width="50%" colspan="2">User Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Invoice:</td>
                <td>{{$payments->invoice}}</td>

                <td>Student Name:</td>
                <td>{{$payments->student_name}}</td>
            </tr>
            <tr>
                <td>Charge ID:</td>
                <td>{{$payments->latest_charge}}</td>

                <td>Email Id:</td>
                <td>{{$payments->student_email}}</td>
            </tr>
            <tr>
                <td>Ordered Date:</td>
                <td>{{$date}}</td>

                <td>Phone:</td>
                <td>{{$payments->student_phone}}</td>
            </tr>
            <tr>
                <td>Payment Mode:</td>
                <td>{{'Credit Card / Debit Card - Stripe'}}</td>

                <td>Address:</td>
                <td>{{$payments->student_address}}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th class="no-border text-start heading" colspan="5">
                    Order Items
                </th>
            </tr>
            <tr class="bg-blue">
                <th>ID</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    {{1}}
                </td>
                <td>
                    School Fees
                </td>
                <td width="10%">{{number_format($payments->payment_amount,2)}}</td>
                <td width="10%">1</td>
                <td width="15%" class="fw-bold">{{number_format($payments->payment_amount,2)}}</td>
            </tr>
            <tr>
                <td colspan="4" class="total-heading">Total Amount :</td>
                <td colspan="1" class="total-heading">{{number_format($payments->payment_amount,2)}} <strong>INR</strong></td>
            </tr>
        </tbody>
    </table>

    <br>
</body>
</html>
