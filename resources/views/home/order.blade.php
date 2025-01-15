<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Order Details</title>
      <!-- Bootstrap core CSS -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- Font Awesome -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom Styles -->
      <link href="home/css/style.css" rel="stylesheet" />
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style>
         body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
         }
         .order-header {
            font-size: 28px;
            font-weight: 700;
            font-family: 'Georgia', serif;
            color: #343a40;
            margin-bottom: 30px;
         }
         .order-card {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            padding: 20px;
         }
         .order-card img {
            max-width: 120px;
            height: auto;
            border-radius: 5px;
            border: 1px solid #ddd;
         }
         .order-card .product-info {
            font-size: 14px;
            color: #555;
         }
         .order-card .product-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
         }
         .badge {
            padding: 0.5em 1em;
            font-size: 0.9rem;
            border-radius: 5px;
         }
         .badge-success {
            background-color: #28a745;
            color: #fff;
         }
         .badge-warning {
            background-color: #ffc107;
            color: #000;
         }
         .badge-info {
            background-color: #17a2b8;
            color: #fff;
         }
         .cancel-button {
            display: inline-block;
            background-color: #dc3545;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
         }
         .cancel-button:hover {
            background-color: #c82333;
            text-decoration: none;
         }
         .order-details-container {
            max-width: 900px;
            margin: 0 auto;
         }
         @media (max-width: 768px) {
            .order-card {
               padding: 15px;
            }
            .order-card img {
               max-width: 80px;
            }
         }
      </style>
   </head>
   <body>
      <div class="container my-5">
         <!-- Header -->
         @include('home.header')

         <!-- Order Details Section -->
         <h1 class="text-center order-header">Order Details</h1>
         <div class="order-details-container">
            @foreach($order as $order)
            <div class="order-card d-flex align-items-center">
               <div class="order-image">
                  <img src="product/{{ $order->image }}" alt="{{ $order->product_title }}" />
               </div>
               <div class="ms-4 w-100">
                  <h3 class="product-title">{{ $order->product_title }}</h3>
                  <p class="product-info mb-2">Quantity: {{ $order->quantity }}</p>
                  <p class="product-info mb-2">Price: ${{ number_format($order->price, 2) }}</p>
                  <p class="product-info mb-2">
                     Payment Status: {{ $order->payment_status }}
                  </p>
                  <p class="product-info mb-3">
                     Delivery Status: {{ $order->delivery_status }}
                  </p>
                  @if($order->delivery_status=='processing')
                  <a onclick="return confirm('Are You Sure To Cancel This Order!')" href="{{url('cancel_order',$order->id)}}" class="cancel-button">Cancel Order</a>
                 
                  @endif
               </div>
            </div>
            @endforeach
         </div>
      </div>

      <!-- Scripts -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <script src="home/js/popper.min.js"></script>
      <script src="home/js/bootstrap.js"></script>
      <script src="home/js/custom.js"></script>
   </body>
</html>
