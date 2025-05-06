<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .receipt-box { border: 1px solid #ccc; padding: 20px; max-width: 400px; margin: auto; }
        .header { text-align: center; font-weight: bold; margin-bottom: 20px; }
        .row { margin-bottom: 10px; }
        .btn { margin-top: 20px; display: flex; justify-content: center; gap: 10px; }
    </style>
    <!-- jsPDF CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>
    <!-- Receipt Container -->
    <div id="receipt-container">
    @foreach($sales as $sale)
        <div class="receipt-box">
            <div class="header">Sales Receipt</div>
            <div class="row">Receipt ID: {{ $sale->id }}</div>
            <div class="row">Product: {{ $sale->product_name }}</div>
            <div class="row">Quantity: {{ $sale->quantity }}</div>
            <div class="row">Price per Unit: {{ number_format($price_per_unit, 2) }} TZS</div>
            <div class="row">Total: {{ number_format($sale->amount, 2) }} TZS</div>
            <div class="row">Payment Method: {{ $sale->payment_method }}</div>
            <div class="row">Seller: {{ $sale->seller_name }}</div>
            <div class="row">Date: {{ $sale->sale_time }}</div>
        </div>
        @endforeach
        </div>

    <!-- Buttons -->
    <div class="btn">
        <button onclick="window.print()">🖨️ Print Receipt</button>
        <button onclick="printReceipt()">📄 Download PDF</button>
    </div>
    <div class="btn">
    <a href="{{ route('pos.index') }}">
        <button>Back to POS</button>
    </a>
</div>


    <!-- Print Receipt with jsPDF -->
    <script>
        function printReceipt() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            const receiptContent = document.getElementById('receipt-container');

            doc.html(receiptContent, {
                callback: function (doc) {
                    doc.save('receipt.pdf');
                },
                margin: [10, 10, 10, 10],
                autoPaging: 'text',
                x: 10,
                y: 10,
                html2canvas: { scale: 0.5 }
            });
        }
    </script>
</body>
</html>
