<h2>Sales Receipt</h2>

@foreach($sales as $sale)
    <div style="border-bottom: 1px solid #ccc; margin-bottom: 10px;">
        <p><strong>Product:</strong> {{ $sale->product_name }}</p>
        <p><strong>Quantity:</strong> {{ $sale->quantity }}</p>
        <p><strong>Price per Unit:</strong> {{ number_format($sale->amount / $sale->quantity, 2) }} TZS</p>
        <p><strong>Total:</strong> {{ number_format($sale->amount, 2) }} TZS</p>
        <p><strong>Payment Method:</strong> {{ $sale->payment_method }}</p>
        <p><strong>Seller:</strong> {{ $sale->seller_name }}</p>
        <p><strong>Time:</strong> {{ $sale->sale_time }}</p>
    </div>
@endforeach

<script>
    window.onload = () => {
        window.print();
        setTimeout(() => {
            window.location.href = "{{ route('pos.index') }}";
        }, 1500);
    };
</script>
