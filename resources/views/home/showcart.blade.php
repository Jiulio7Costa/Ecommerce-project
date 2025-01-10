<!DOCTYPE html>
<html lang="en">
<head>
   <!-- Basic -->
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <title>Cart - Famms</title>
   <!-- Bootstrap core CSS -->
   <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
   <!-- Font Awesome -->
   <link href="home/css/font-awesome.min.css" rel="stylesheet" />
   <!-- Custom styles -->
   <link href="home/css/style.css" rel="stylesheet" />
   <!-- Responsive styles -->
   <link href="home/css/responsive.css" rel="stylesheet" />
   <style>
      body {
         background-color: #f5f5f5;
      }

      .cart-container {
         margin: 50px auto;
         width: 100%;
         max-width: 2000px;
         padding: 20px;
         background-color: #fff;
         border-radius: 8px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }

      .cart-header {
         font-size: 24px;
         font-weight: bold;
         margin-bottom: 20px;
         color: #333;
      }

      .cart-items {
         border-top: 1px solid #ddd;
         padding-top: 20px;
      }

      .cart-item {
         display: flex;
         align-items: center;
         justify-content: space-between;
         margin-bottom: 20px;
         padding: 20px;
         border: 1px solid #ddd;
         border-radius: 8px;
         background-color: #f9f9f9;
      }

      .cart-item img {
         width: 100px;
         height: 100px;
         object-fit: cover;
         border-radius: 8px;
      }

      .cart-item-details {
         flex: 1;
         margin-left: 20px;
      }

      .cart-item-details h5 {
         font-size: 18px;
         color: #333;
         margin-bottom: 8px;
      }

      .cart-item-details p {
         font-size: 14px;
         margin: 0;
         color: #666;
      }

      .cart-item-actions {
         text-align: right;
         min-width: 120px;
      }

      .cart-item-actions a {
         font-size: 14px;
         color: white;
         background-color: #d9534f;
         padding: 8px 15px;
         border-radius: 5px;
         text-decoration: none;
         font-weight: bold;
         transition: background-color 0.3s ease;
      }

      .cart-item-actions a:hover {
         background-color: #c9302c;
      }

      .cart-summary {
         margin-top: 30px;
         padding: 15px;
         border: 1px solid #ddd;
         border-radius: 8px;
         background-color: #f9f9f9;
      }

      .cart-summary h4 {
         font-size: 18px;
         font-weight: bold;
         margin-bottom: 10px;
      }

      .cart-summary p {
         font-size: 16px;
         margin-bottom: 15px;
         color: #333;
      }

      .checkout-section {
         text-align: right;
      }

      .checkout-btn {
         font-size: 14px;
         font-weight: bold;
         color: white;
         background-color: #007bff;
         padding: 12px 25px;
         border-radius: 5px;
         text-decoration: none;
         transition: background-color 0.3s ease;
      }

      .checkout-btn:hover {
         background-color: #0056b3;
      }
   </style>
</head>
<body>
   <div class="hero_area">
      <!-- Header Section -->
      @include('home.header')
      <!-- End Header Section -->
      
      @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('message') }}
            </div>
            @endif

      <div class="cart-container">
         <h2 class="cart-header">Shopping Cart</h2>

         <div class="cart-items">
            <?php $totalprice = 0; ?> <!-- Initialize the variable -->
            @foreach($cart as $cartItem)
            <div class="cart-item">
               <img src="/product/{{ $cartItem->image }}" alt="{{ $cartItem->product_title }}">
               <div class="cart-item-details">
                  <h5>{{ $cartItem->product_title }}</h5>
                  <p>Quantity: {{ $cartItem->quantity }}</p>
                  <p>Price: ${{ number_format($cartItem->price, 2) }}</p>
                  <p>Size: {{ $cartItem->size ?? 'N/A' }}</p>
                  <p>Color: {{ $cartItem->color ?? 'N/A' }}</p>
               </div>
               <div class="cart-item-actions">
                  <a onclick="return confirm('Are You Sure To Remove Product')" href="{{ url('/remove_cart', $cartItem->id) }}">Remove Product</a>
               </div>
            </div>
            <?php 
               $totalprice += $cartItem->price; 
            ?>
            @endforeach
         </div>

        <!-- Order Summary -->
<div class="cart-summary">
   <h4 style="font-family: 'Montserrat', sans-serif; font-weight: 600; font-size: 18px; color: #333;">Order Summary</h4>
   <p style="font-family: 'Roboto', sans-serif; font-size: 16px;">Total Price: <strong style="font-family: 'Roboto', sans-serif; font-size: 16px;">${{ number_format($totalprice, 2) }}</strong></p>
</div>

<!-- Payment Options -->
<div style="text-align: center; margin-top: 20px;">
   <h1 style="font-family: 'Montserrat', sans-serif; font-weight: 700; font-size: 36px; color: #333;">Proceed to Order</h1>
   <a href="{{ url('cash_order') }}" class="btn btn-danger" style="margin: 10px; font-family: 'Roboto', sans-serif; font-weight: 500; font-size: 14px;">Cash On Delivery</a>
   <a href="{{ url('pay_using_card') }}" class="btn btn-danger" style="margin: 10px; font-family: 'Roboto', sans-serif; font-weight: 500; font-size: 14px;">Pay Using Card</a>
</div>



      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         </p>
      </div>
   </div>
   

   <!-- jQuery -->
   <script src="home/js/jquery-3.4.1.min.js"></script>
   <!-- Popper JS -->
   <script src="home/js/popper.min.js"></script>
   <!-- Bootstrap JS -->
   <script src="home/js/bootstrap.js"></script>
   <!-- Custom JS -->
   <script src="home/js/custom.js"></script>
</body>
</html>
