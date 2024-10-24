<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice-{{$order->transaction_id}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .logo {
            text-align: center;
        }

        .header-text {
            text-align: center;
            margin-top: 10px;
        }

        table {
            width: 100%;
            line-height: 24px;
            text-align: left;
            border-collapse: collapse;
        }

        table td {
            padding: 8px;
        }

        .invoice-details {
            margin-bottom: 20px;
        }

        .invoice-header,
        .invoice-footer {
            margin-top: 20px;
        }

        .heading {
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ddd;
        }

        .invoice-items table,
        .invoice-footer table {
            border: 1px solid #ddd;
            border-collapse: collapse;
        }

        .invoice-items th,
        .invoice-items td,
        .invoice-footer th,
        .invoice-footer td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .footer-right {
            text-align: right;
        }

        p {
            font-size: 14px;
        }

        td {
            font-size: 14px;
        }

        button {
            padding: 10px 25px;
            font-size: 25px;
            border-radius: 15px;
            cursor: pointer;
            border: 0;
            outline: 0;
            width: 250px;
            position: fixed;
            font-weight: 600;
        }

        .btn-print {
            right: 50px;
            bottom: 50px;
            background-color: black;
            color: white;
        }

        .btn-download {
            right: 50px;
            bottom: 120px;
            background-color: grey;
            color: white;
        }

        @media print {

            .no-print {
                display: none;
            }
        }
        span{
            font-weight: 700;
            text-transform: uppercase;
            font-size: 16px;
        }
    </style>
</head>

<body>

    <div class="invoice-box" id="invoice">
        <div class="logo">
            <img src="{{asset('ego/ego_logo_black.png')}}" width="150px" alt="">
            <p>98/6-A, Boro Moghbazar, Dhaka-1217, Bangladesh</p>
            <p>+880-2-222229964, customer.service@fg-bd.com</p>
        </div>

        <div class="header-text">
            <h2>Invoice</h2>
        </div>

        <div class="invoice-details">
            <table>
                <tr>
                    <td><strong>Invoice No:</strong> {{$order->transaction_id}}</td>
                    <td><strong>Invoice Date:</strong> {{$order->created_at->format('d-m-Y')}}</td>
                    <td style="display: flex; justify-content: end;">{!! $qrCode !!}</td>
                </tr>
                <tr>
                    <td><strong>Payment Status:</strong>
                    @if($order->payment_status == 'unpaid') 
                    <span style="color: red;">{{$order->payment_status}}</span>
                    @else 
                    <span style="color: green;">{{$order->payment_status}}</span>
                    @endif</td>
                    <td rowspan="2" style="text-align:right;"></td>
                </tr>
                <tr>
                    <td><strong>Customer Name:</strong> {{$order->name}}</td>
                    
                </tr>
            </table>
        </div>

        <div class="invoice-address">
            <table>
                <tr>
                    <td><strong>Shipping Address 1:</strong></td>
                    <td>{{$order->address_one}}</td>
                </tr>
                <tr>
                    <td><strong>Mobile:</strong></td>
                    <td>{{$order->phone}}</td>
                </tr>
                <tr>
                    <td><strong>Order Date:</strong></td>
                    <td>{{$order->created_at->format('d-m-Y')}}</td>
                </tr>
            </table>
        </div>

        <div class="invoice-items">
            <table>
                <thead>
                    <tr class="heading">
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Amount in BDT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                    <tr>
                        <td>{{$item->product->name}} {{$item->power ? ($item->power):''}} - {{$item->pair}} Pcs</td>
                        <td>{{$item->pair}}</td>
                        <td>{{$item->price}} BDT</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="2">Subtotal</td>
                        <td>{{$order->subtotal}} BDT</td>
                    </tr>
                    <tr>
                        <td colspan="2">VAT (5%)</td>
                        <td>20 BDT</td>
                    </tr>
                    @if($order->discount)
                    <tr>
                        <td colspan="2">Discount</td>
                        <td>- {{$order->discount}} BDT</td>
                    </tr>
                    @endif
                    <tr>
                        <td colspan="2">SHIPPING</td>
                        <td>{{$order->delivery_charge}} BDT</td>
                    </tr>
                    <tr>
                        <td colspan="2"><strong>Total Bill Amount</strong></td>
                        <td><strong>{{$order->amount}} BDT</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="invoice-footer">
            <table>
                <tr>
                    <td><strong>Remarks:</strong></td>
                    <td><strong>Payment Method:</strong> {{$order->payment_method == 'cod' ? 'Cash On Delivery' : 'Online Payment'}}</td>
                </tr>
            </table>
        </div>
    </div>

    <div style="text-align:center; margin-top:20px;" class="no-print">
        <button class="btn btn-print" onclick="printInvoice()">Print</button>
        <button class="btn btn-download" onclick="downloadPDF()">Download PDF</button>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

    <script>
        // Function to print the invoice
        function printInvoice() {
            window.print();
        }

        function downloadPDF() {
            var element = document.getElementById('invoice');
            var id = `{{ $order->transaction_id }}`;
            var opt = {
                margin: 0.5,
                filename: `invoice-${id}.pdf`,
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'portrait'
                }
            };
            html2pdf().from(element).set(opt).save();
        }
    </script>

</body>

</html>