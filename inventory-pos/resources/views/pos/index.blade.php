<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin | Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Admin | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
    <meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard" />
    <meta name="csrf-token" content="{{ csrf_token() }}">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@4.0.0-beta3/dist/css/adminlte.min.css" crossorigin="anonymous" />
    <!-- fonts only*/-->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">

    <style>
        @keyframes colorShift {
    0%   { color: rgb(247, 229, 65); }   /* Yellow */
    25%  { color: #001a33; }             /* Deep navy */
    50%  { color: #28a745; }             /* Green */
    75%  { color: #dc3545; }             /* Red */
    100% { color: rgb(247, 229, 65); }   /* Back to yellow */
}

.animated-color {
    animation: colorShift 5s infinite;
}
.disney-font {
            font-family: 'Pacifico', cursive;
        }
        .fredoka-font {
    font-family: 'Fredoka', sans-serif;
}
.kaushan-font {
            font-family: 'Kaushan Script', cursive;
        }


.btn-secondary {
    background-color: #001a33 !important;
    color: #fff !important;
    border: none;
}

.btn-secondary:hover {
    background-color: #003366 !important;
}
        .table th, .table td {
            text-align:left;
        }
        .table input[type="number"] {
        width: 50px; /* Set a fixed width for the input fields */
        text-align: left; /* Center the text in the input fields */
    }
    .card-body {
        padding: 1rem;
    } 

        .category-card {
            transition: background-color 0.3s ease;
            height: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            cursor: pointer;
        }
        .category-card:hover, .category-card.active {
            background-color: rgb(179, 179, 179);
            color: white;
        }
        .product-card {
            transition: background-color 0.3s ease;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            cursor: pointer;
        }
        .product-card:hover, .product-card.active {
            background-color: #f0f0f0;
        }
        .custom-header {
  background-color: #001a33 ;
}
.custom-header .nav-link {
  color: #fff;
}
.card-header {
  background-color:rgb(0, 26, 51); /* Blue background */
  color: #ffffff;            /* White text */
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-size: 1.25rem;        /* Slightly larger font */
  font-weight: bold;         /* Bold text */
  padding: 10px 16px;        /* Spacing around the text */
  border-bottom: 2px rgb(0, 26, 51); /* Optional border */
  border-radius: 8px 8px 0 0; /* Rounded top corners */
}
 



    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

</head>
<body>
@include('admin.body.header')
<div class="app-wrapper">

    <div class="container-fluid mt-4">
    <h1 class="display-4 fw-bold disney-font text-center animated-color">Point of Sale </h1>
            <div class="row g-0">
                <div class="col-md-8  pe-md-3">
                    <div class="card h-100">
                        <div class="card-header">Cart</div>
                        <div class="card-body">
                            
    <!-- Barcode Scanner Input -->
    <div class="mb-3">
       <!-- <label for="pos-barcode" class="form-label">Scan Product Barcode:</label>-->
        <input type="text" id="pos-barcode" class="form-control"  autocomplete="off"  style="position:absolute; opacity:0; left: -9999px;" />
    </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Cart Item</th>
                                        <th>Product_id</th>
                                        <th>Disc (%)</th>
                                        <th>Qty</th>
                                        <th>Total (excl.)</th>
                                        <th>Total (inc. tax)</th>
                                    </tr>
                                </thead>
                                <tbody id="cart-list"></tbody>
                            </table>
                            <hr>
                            <strong>Total: <span id="cart-total">0 TSH</span></strong>
                            <div class="d-grid gap-2 mt-3">
                                <button class="btn btn-secondary" onclick="openPaymentModal()">Place Order</button>
                                <br>
                            </div>
                        </div>
                    </div><br>
                </div>
                
                <div class="col-md-4  pe-md-3 ">
                    <div class="card h-100">
                        <div class="card-header">Calculator</div>
                        <div class="card-body text-center">
                            <input type="text" id="calculator-input" class="form-control mb-2" readonly>
                            <div class="row g-2">
                                @for($i = 1; $i <= 9; $i++)
                                    <div class="col-4">
                                    <button class="btn btn-success w-100" onclick="addNumber('{{ $i }}')">{{ $i }}</button>
                                    </div>
                                @endfor
                                <div class="col-4"><button class="btn btn-success w-100" onclick="addNumber('0')">0</button></div>
                                <div class="col-4"><button class="btn btn-warning w-100" onclick="clearInput()">C</button></div>
                                <div class="col-4"><button class="btn btn-danger w-100" onclick="deleteLast()">&#x232B;</button></div>
                                <div class="col-4"><button class="btn btn-info w-100" onclick="addOperator('+')">+</button></div>
                                <div class="col-4"><button class="btn btn-info w-100" onclick="addOperator('-')">-</button></div>
                                <div class="col-4"><button class="btn btn-info w-100" onclick="addOperator('*')">*</button></div>
                                <div class="col-4"><button class="btn btn-info w-100" onclick="addOperator('/')">/</button></div>
                                <div class="col-4"><button class="btn btn-primary w-100" onclick="calculateResult()">=</button></div>
                                <div class="col-4"><button class="btn btn-info w-100" onclick="addDecimal()">.</button></div>
                            </div>
                        </div>
                    </div>
                </div>

 <!-- Spacer Between Top and Bottom Rows -->
 <div class="my-4"></div>


                <div class="row g-0">
                <div class="col-md-4 pe-md-3">
                    <div class="card h-100">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($categories as $category)
                                    <div class="col-md-6 mb-3">
                                        <div class="card category-card" onclick="fetchProducts({{ $category->id }})">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">{{ $category->name }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
            <div class="col-md-8 pe-md-3">
    <div class="card h-100">
        <div class="card-header">Products</div>
        <div class="card-body">
            <div id="product-container" class="row">
                <!-- Products will be displayed here -->
            </div>
        </div>
    </div>
</div>
</div>


<!-- Payment Method Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Select Payment Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="payment-method" class="form-label">Choose Payment Method</label>
                    <select id="payment-method" class="form-select" >
                        <option value="cash" selected>Cash</option>
                        <option value="bank">Bank Transfer</option>
                        <option value="mobile money">Mobile Money</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="submitSale()">Submit Sale</button>
            </div>
        </div>
    </div>
</div>
@include('admin.body.footer')




<script>
    function fetchProducts(categoryId) {
        console.log(`Fetching products for category ID: ${categoryId}`);
        fetch(`/pos/category/${categoryId}/products`)
            .then(response => {
                console.log('Response:', response);
                return response.text();
            })
            .then(html => {
                console.log('HTML:', html);
                document.getElementById('product-container').innerHTML = html;
            })
            .catch(error => console.error('Error fetching products:', error));
    }

    let cart = [];
    let total = 0;

    function addNumber(num) {
        const input = document.getElementById('calculator-input');
        input.value += num;
    }

    function addOperator(operator) {
        const input = document.getElementById('calculator-input');
        const lastChar = input.value[input.value.length - 1];
        // Prevent adding multiple operators in a row
        if (['+', '-', '*', '/'].includes(lastChar)) {
            input.value = input.value.slice(0, -1); // Remove last operator
        }
        input.value += operator;
    }

    function addDecimal() {
        const input = document.getElementById('calculator-input');
        if (!input.value.includes('.')) input.value += '.';
    }

    function clearInput() {
        document.getElementById('calculator-input').value = '';
    }

    function deleteLast() {
        const input = document.getElementById('calculator-input');
        input.value = input.value.slice(0, -1);
    }

    function calculateResult() {
        const input = document.getElementById('calculator-input');
        try {
            // Evaluate the expression
            const result = eval(input.value);
            input.value = result;
        } catch (error) {
            alert('Invalid calculation');
            clearInput();
        }
    }

  function addToCart(product) {
    console.log(product.product_id);

    const qty = 1;
    const discountPercent = product.discount || 0;
    const price = parseFloat(product.price);
    const taxRate = (parseFloat(product.tax_rate) || 0) / 100; // Convert percent to decimal if stored as whole number

    // Check if product already in cart
    const existingItemIndex = cart.findIndex(item => item.product_id === product.product_id);

    if (existingItemIndex !== -1) {
        // Product exists – update quantity
        const item = cart[existingItemIndex];
        item.qty += qty;

        // Recalculate totals
        const discountValue = (item.discount / 100) * (item.price * item.qty);
        const totalExclTax = (item.price * item.qty) - discountValue;
        const totalInclTax = totalExclTax * (1 + taxRate);

        item.totalExcl = totalExclTax.toFixed(2);
        item.totalIncl = totalInclTax.toFixed(2);
    } else {
        // New product – add to cart
        const discountValue = (discountPercent / 100) * price * qty;
        const totalExclTax = (price * qty) - discountValue;
        const totalInclTax = totalExclTax * (1 + taxRate);

        const cartItem = {
            product_id: product.product_id,
            name: product.name,
            price: price,
            discount: discountPercent,
            qty: qty,
            taxRate: taxRate,
            totalExcl: totalExclTax.toFixed(2),
            totalIncl: totalInclTax.toFixed(2),
        };

        cart.push(cartItem);
    }

    updateCart();
    clearInput();
}


    function updateQuantity(index, newQty) {
        const item = cart[index];

        // Validate the new quantity
        const parsedQty = parseFloat(newQty);
        if (isNaN(parsedQty) || parsedQty < 0) {
            alert('Invalid quantity');
            return;
        }

        // Update the quantity
        item.qty = parsedQty;

        // Recalculate totals based on the new quantity
        const discountValue = (item.discount / 100) * (item.price * item.qty);
        const totalExclTax = (item.price * item.qty) - discountValue;
        const totalInclTax = totalExclTax * (1 + item.taxRate);

        // Update the totals in the cart item
        item.totalExcl = totalExclTax.toFixed(2);
        item.totalIncl = totalInclTax.toFixed(2);

        // Update the cart display
        updateCart();
    }

    function updateDiscount(index, newDiscount) {
        const item = cart[index];

        // Validate the new discount
        const parsedDiscount = parseFloat(newDiscount);
        if (isNaN(parsedDiscount) || parsedDiscount < 0 || parsedDiscount > 100) {
            alert('Invalid discount');
            return;
        }

        // Update the discount
        item.discount = parsedDiscount;

        // Recalculate totals based on the new discount
        const discountValue = (item.discount / 100) * (item.price * item.qty);
        const totalExclTax = (item.price * item.qty) - discountValue;
        const totalInclTax = totalExclTax * (1 + item.taxRate);

        // Update the totals in the cart item
        item.totalExcl = totalExclTax.toFixed(2);
        item.totalIncl = totalInclTax.toFixed(2);

        // Update the cart display
        updateCart();
    }

    function updateCart() {
        const cartList = document.getElementById('cart-list');
        cartList.innerHTML = '';
        total = 0;

        cart.forEach((item, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.name}</td>
                 <td>${item.product_id}</td>
                <td>
                    <input type="number" value="${item.discount}" min="0" max="100" step="0.25" onchange="updateDiscount(${index}, this.value)" />
                </td>
                <td>
                    <input type="number" value="${item.qty}" min="0" step="0.25" onchange="updateQuantity(${index}, this.value)" />
                </td>
                <td>${item.totalExcl} TSH</td>
                <td>${item.totalIncl} TSH</td>
                <td><button class="btn btn-danger" onclick="removeFromCart(${index})">Delete</button></td>
            `;
            cartList.appendChild(row);
            total += parseFloat(item.totalIncl);
        });

        document.getElementById('cart-total').innerText = total.toFixed(2) + ' TSH';
    }

    function removeFromCart(index) {
        cart.splice(index, 1);
        updateCart();
    }

    function openPaymentModal() {
        if (cart.length === 0) {
            alert('No items in cart to submit!');
            return;
        }
        // Show the payment modal
        const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
        paymentModal.show();
    }


    function submitSale() {
        //console.log('CSRF Token:', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        console.log("Submit Sale button clicked");

        if (cart.length === 0) {
        alert('Cart is empty!');
        return;
        }

        const paymentMethod = document.getElementById('payment-method').value;
       // if (!paymentMethod) {
        //    alert('Please select a payment method.');
         //   return;
        //}

        // Prepare data to send to the server
        const saleData = {
            cart: cart,  // Send the cart items to the server
            payment_method: paymentMethod, // Include the selected payment method
            _token: '{{ csrf_token() }}' // Include CSRF token for security
        };

        // Log the cart contents before submission
    console.log('Cart before submission:', cart);


      

    $.ajax({
        url: '/pos/submit-sale',
        method: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(saleData),
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success: function(response) {
            if (response.success) {
                cart = [];
                updateCart();
                const paymentModal = bootstrap.Modal.getInstance(document.getElementById('paymentModal'));
                paymentModal.hide();

                // Show the receipt on the page
                //printReceipt(response);

                // Optional: redirect to receipt page
                window.location.href = response.redirect;
            } else {
                alert('Sale recorded, but no receipt found.');
            }
        },
        error: function(error) {
            console.error('Error recording sale:', error);
            alert('Error recording sale: ' + error.responseJSON.message);
        }
    });
}
    
function printReceipt(response) {
    // Check if sales is an array
    if (!Array.isArray(response.sales)) {
        console.error('Sales data is not an array:', response.sales);
        alert('No sales data found.');
        return;
    }

    // Show a loading message or spin the UI
    alert('Processing the sale... Redirecting to the receipt page.');

    // Redirect to the receipt page generated by the backend
    window.location.href = response.redirect;
}

   
</script>

 
<!-- <script>
      window.onload = function() {
        document.getElementById('pos-barcode').focus();
    };
    
    document.getElementById('pos-barcode').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            let barcode = e.target.value.trim();

            if (barcode === '') return;

            fetch(`/pos/barcode/${barcode}`)
                .then(res => {
                    if (!res.ok) throw new Error('Product not found');
                    return res.json();
                })
                .then(product => {
                    addToCart(product);
                    document.getElementById('pos-barcode').value = '';
                })
                .catch(err => {
                    alert(err.message);
                    document.getElementById('pos-barcode').value = '';
                    
                });
        }
    });
</script>


Begins barcode scripts-->
<script>
    const barcodeInput = document.getElementById('pos-barcode');

    function isAnyModalOpen() {
        return document.querySelector('.modal.show') !== null;
    }

    // Check if user is editing a number input
    function isTypingInCartInput() {
        const active = document.activeElement;
        return active.tagName === 'INPUT' && active.type === 'number';
    }

    // Focus barcode input only on page load if not editing
    window.onload = () => {
        if (!isAnyModalOpen() && !isTypingInCartInput()) {
            barcodeInput.focus();
        }
    };

    // Click anywhere else? Focus barcode input, unless editing cart
    document.addEventListener('click', (e) => {
        if (!isAnyModalOpen() && !isTypingInCartInput()) {
            barcodeInput.focus();
        }
    });

    // Keydown (scanner input) – don't steal focus if editing
    document.addEventListener('keydown', (e) => {
        if (!isAnyModalOpen() && !isTypingInCartInput()) {
            barcodeInput.focus();
        }
    });

    // Prevent losing barcode input focus unless user is editing
    barcodeInput.addEventListener('blur', () => {
        setTimeout(() => {
            if (!isAnyModalOpen() && !isTypingInCartInput()) {
                barcodeInput.focus();
            }
        }, 50); // slight delay to allow interaction
    });

    // Barcode scan handling
    barcodeInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            const barcode = e.target.value.trim();
            if (barcode === '') return;

            fetch(`/pos/barcode/${barcode}`)
                .then(res => {
                    if (!res.ok) throw new Error('Product not found');
                    return res.json();
                })
                .then(product => {
                    addToCart(product);
                    barcodeInput.value = '';
                })
                .catch(err => {
                    alert(err.message);
                    barcodeInput.value = '';
                })
                .finally(() => {
                    if (!isAnyModalOpen() && !isTypingInCartInput()) {
                        barcodeInput.focus();
                    }
                });
        }
    });
</script>





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>



</body>
</html>