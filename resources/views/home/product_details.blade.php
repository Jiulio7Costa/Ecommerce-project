<!DOCTYPE html>
<html>
   <head>
      <style>
         .label-bold-black {
            font-weight: bold;
            color: black;
         }

         .product-details {
            display: table;
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
         }

         .product-details-row {
            display: table-row;
         }

         .product-details-cell {
            display: table-cell;
            padding: 10px 15px;
            vertical-align: top;
         }

         .product-details-label {
            font-weight: bold;
            color: black;
            text-align: right;
            width: 40%;
         }

         .product-details-value {
            color: #333;
            text-align: left;
            width: 60%;
         }

         .img-box {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
         }

         .img-box img {
            max-width: 100%;
            max-height: 300px;
            object-fit: contain;
         }

         .dropdown-row {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 10px 0;
         }

         .dropdown-label {
            font-weight: bold;
            color: black;
            margin-right: 10px;
         }

         /* Adjusted to ensure the dropdown does not get overlapped by arrow */
         .dropdown-select {
            flex: 1;
            max-width: 200px;
            padding-right: 30px; /* Add space for the dropdown arrow */
            appearance: none; /* Removes default arrow on some browsers */
            -webkit-appearance: none; /* Safari */
            -moz-appearance: none; /* Firefox */
            background: url('https://upload.wikimedia.org/wikipedia/commons/thumb/e/e8/Font_Awesome_5_solid_caret-down.svg/768px-Font_Awesome_5_solid_caret-down.svg.png') no-repeat right center;
            background-size: 12px 12px; /* Set the size of the arrow */
         }

         .form-control {
            width: 100%;
         }

         .centered-section {
            display: flex;
            flex-direction: column;
            align-items: center;
         }

         .form-group {
            margin-bottom: 15px;
         }

         button {
            margin-top: 20px;
         }
      </style>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="image/png">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
   </head>
   <body>
      <div class="hero_area">
         <!-- Header Section -->
         @include('home.header')
         <!-- Product Details Section -->
         <div class="container text-center py-5">
            <div class="img-box mb-4">
               <img src="/product/{{$product->image}}" 
                    alt="{{$product->title}}">
            </div>
            <h5 style="font-size: 20px; color: #333; margin-bottom: 15px;">{{$product->title}}</h5>
            @if($product->discount_price != null)
               <h6 style="font-size: 16px; color: #e74c3c; text-decoration: line-through;">${{$product->price}}</h6>
               <h6 style="font-size: 18px; color: #28a745; font-weight: bold;">${{$product->discount_price}}</h6>
            @else
               <h6 style="font-size: 18px; color: #333;">${{$product->price}}</h6>
            @endif

            <div class="product-details">
               <div class="product-details-row">
                  <div class="product-details-cell product-details-label">Product Category:</div>
                  <div class="product-details-cell product-details-value">{{$product->category}}</div>
               </div>
               <div class="product-details-row">
                  <div class="product-details-cell product-details-label">Product Details:</div>
                  <div class="product-details-cell product-details-value">{{$product->description}}</div>
               </div>
               <div class="product-details-row">
                  <div class="product-details-cell product-details-label">Stock Available:</div>
                  <div class="product-details-cell product-details-value">{{$product->quantity}}</div>
               </div>
            </div>

            <!-- Form for Adding to Cart -->
            <form action="{{url('add_cart', $product->id)}}" method="POST" style="margin-top: 20px;">
               @csrf
               <div class="centered-section">
                  <!-- Quantity Dropdown -->
                  <div class="dropdown-row">
                     <label for="quantity" class="dropdown-label">Quantity:</label>
                     <select name="quantity" class="form-control dropdown-select" required>
                        <option value="1" selected>1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                     </select>
                  </div>

                  <!-- Color Dropdown -->
                  @if(!empty($product->color))
                     @php
                        $decodedColors = json_decode($product->color, true);
                     @endphp
                     @if(is_array($decodedColors) && count($decodedColors) > 0)
                        <div class="dropdown-row">
                           <label for="color" class="dropdown-label">Select Color:</label>
                           <select name="color" class="form-control dropdown-select" required>
                              <option value="" disabled selected>Select Color</option>
                              @foreach($decodedColors as $color)
                                 <option value="{{ $color }}">{{ $color }}</option>
                              @endforeach
                           </select>
                        </div>
                     @endif
                  @endif

                  <!-- Size Dropdown -->
                  @if(!empty($product->size))
                     @php
                        $decodedSizes = json_decode($product->size, true);
                     @endphp
                     @if(is_array($decodedSizes) && count($decodedSizes) > 0)
                        <div class="dropdown-row">
                           <label for="size" class="dropdown-label">Select Size:</label>
                           <select name="size" class="form-control dropdown-select" required>
                              <option value="" disabled selected>Select Size</option>
                              @foreach($decodedSizes as $size)
                                 <option value="{{ $size }}">{{ $size }}</option>
                              @endforeach
                           </select>
                        </div>
                     @endif
                  @endif

                  <!-- Add to Cart Button -->
                  <button type="submit" class="btn btn-primary">Add to Cart</button>
               </div>
            </form>
         </div>
         <!-- Footer Section -->
         @include('home.footer')
         <div class="cpy_">
            <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
               Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
            </p>
         </div>
         <!-- Scripts -->
         <script src="{{asset('home/js/jquery-3.4.1.min.js')}}"></script>
         <script src="{{asset('home/js/popper.min.js')}}"></script>
         <script src="{{asset('home/js/bootstrap.js')}}"></script>
         <script src="{{asset('home/js/custom.js')}}"></script>
      </div>
   </body>
</html>
