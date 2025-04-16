<!DOCTYPE html>
<html>
<head>
    <title>Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .receipt-box { border: 1px solid #ccc; padding: 20px; max-width: 400px; margin: auto; }
        .header { text-align: center; font-weight: bold; margin-bottom: 20px; }
        .row { margin-bottom: 10px; }
        .btn { margin-top: 20px; display: block; text-align: center; }
    </style>
</head>
<body>
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

        <div class="btn">
            <button onclick="window.print()">🖨️ Print Receipt</button>
        </div>
    </div>
</body>
<script>
    window.onload = function() {
        window.print();

        // Optional: Go back to POS after printing
        setTimeout(function() {
            window.location.href = "{{ route('pos.index') }}";
        }, 1000);
    }
</script>

</html>
