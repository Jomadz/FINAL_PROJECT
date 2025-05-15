<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    <style>
        body { font-family: Arial, sans-serif;
            margin:  0;
            padding: 0;
            display: flex;
            justify-content: center;
            background: #f4f4f4;}
        
            .receipt-container {
            width: 80mm;
            background: white;
            padding: 10px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }

        .header {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .row {
            margin-bottom: 5px;
            font-size: 12px;
        }

        table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        th, td {
            padding: 4px 0;
            font-size: 12px;
            text-align: left;
        }

        th {
            border-bottom: 1px dashed #000;
        }

        .total {
            text-align: right;
            font-weight: bold;
            font-size: 13px;
            margin-top: 10px;
        }

        .buttons {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
        }
        table, th, td {
        border: none;
    }
    @media print {
        body * {
            visibility: hidden;
        }

        .receipt-box, .receipt-box * {
            visibility: visible;
        }

        .receipt-box {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: none;
        }

        .btn-group {
            display: none;
        }
    }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body>
    <div id="receipt-container">
        <div class="receipt-box">
            <div class="header">Sales Receipt</div>
            <div class="row">Date: {{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}</div>
            <div class="row">Seller: {{ $sales->first()->seller_name ?? 'N/A' }}</div>
            <div class="row">Payment Method: {{ $sales->first()->payment_method ?? 'Unknown' }}</div>

            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Price/Unit</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->product->product_name }} (ID: {{ $sale->product->id }})</td>
                            <td>{{ $sale->quantity }}</td>
                            <td>{{ number_format($sale->total_price  / $sale->quantity, 2) }} TZS</td>
                            <td>{{ number_format($sale->total_price, 2) }} TZS</td>
                        </tr>
                        @php $total += $sale->total_price; @endphp
                    @endforeach
                </tbody>
            </table>

            <div class="total">Grand Total: {{ number_format($total, 2) }} TZS</div>
        
        <div class="total">Payment Method: {{ $sales->first()->payment_method ?? 'Unknown' }}</div>
</div>
    <div class="btn-group">
        <button onclick="window.print()">🖨️ Print</button>
        <button onclick="downloadPDF()">📄 Download PDF</button>
        <a href="{{ route('pos.index') }}"><button>Back to POS</button></a>
    </div>
    </div>
    

    <script>
    async function downloadPDF() {
        const { jsPDF } = window.jspdf;
        const receipt = document.querySelector('.receipt-box');

        const canvas = await html2canvas(receipt, {
            scale: 2,
            useCORS: true,
        });

        const imgData = canvas.toDataURL('image/png');
        const imgProps = {
            width: canvas.width,
            height: canvas.height
        };

        const pxPerMm = imgProps.width / receipt.offsetWidth;
        const pdfWidth = 80; // mm (receipt width)
        const pdfHeight = imgProps.height / pxPerMm;

        const pdf = new jsPDF({
            orientation: 'portrait',
            unit: 'mm',
            format: [pdfWidth, pdfHeight]
        });

        pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
        pdf.save('receipt.pdf');
    }
</script>

</body>
</html>
