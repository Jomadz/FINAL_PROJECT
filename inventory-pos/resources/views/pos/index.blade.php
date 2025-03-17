@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Point of Sale (POS)</h1>

    <div class="row">
        <div class="col-md-6">
            <h3>Products</h3>
            <ul class="list-group">
                @foreach($products as $product)
                    <li class="list-group-item">
                        <strong>{{ $product->name }}</strong> - ${{ $product->price }}
                        <button class="btn btn-primary btn-sm float-end add-to-cart" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-price="{{ $product->price }}">Add to Cart</button>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-6">
            <h3>Cart</h3>
            <ul class="list-group" id="cart">
                <!-- Cart items will be dynamically added here -->
            </ul>
            <h4>Total: $<span id="total">0.00</span></h4>
            <button class="btn btn-success" id="checkout">Checkout</button>
        </div>
    </div>
</div>

<script>
    let cart = [];
    let total = 0;

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const price = parseFloat(this.getAttribute('data-price'));

            // Add to cart
            cart.push({ id, name, price });
            total += price;

            // Update cart display
            updateCart();
        });
    });

    function updateCart() {
        const cartList = document.getElementById('cart');
        cartList.innerHTML = ''; // Clear current cart

        cart.forEach(item => {
            const li = document.createElement('li');
            li.className = 'list-group-item';
            li.textContent = `${item.name} - $${item.price.toFixed(2)}`;
            cartList.appendChild(li);
        });

        document.getElementById('total').textContent = total.toFixed(2);
    }

    document.getElementById('checkout').addEventListener('click', function() {
        // Handle checkout logic here
        alert('Checkout not implemented yet!');
    });
</script>
@endsession
