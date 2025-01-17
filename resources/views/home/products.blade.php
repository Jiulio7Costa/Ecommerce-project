<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
   </head>
   <body>
      <div class="hero_area">
         <!-- header section starts -->
         @include('home.header')
         <!-- end header section -->
       
         <!-- product section -->
         <section class="product_section layout_padding">
            <div class="container">
                <div class="heading_container heading_center">
                    <h2 style="font-size: 36px; color: #333;">
                        Our Products
                    </h2>

                    <div style="display: flex; justify-content: center; margin: 1rem 0;">
                        <form action="{{url('product_search1')}}" method="GET" style="display: flex; gap: 0.5rem;">
                            @csrf
                            <input 
                                type="text" 
                                name="search" 
                                placeholder="Search for a product" 
                                style="padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px; font-size: 1rem; box-sizing: border-box; height: 40px;" 
                                aria-label="Search for a product"
                            >
                            <button 
                                type="submit" 
                                style="padding: 0 1rem; background-color: #007bff; color: #fff; border: none; border-radius: 4px; font-size: 1rem; cursor: pointer; height: 40px; display: flex; align-items: center; justify-content: center;"
                            >
                                Search
                            </button>
                        </form>
                    </div>
                    
                </div>
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="box" style="border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); overflow: hidden; background-color: #fff;">
                                <div class="option_container" style="padding: 15px; background-color: #f8f9fa;">
                                    <div class="options">
                                        <a href="{{url('product_details', $product->id)}}" 
                                           class="option1" 
                                           style="font-size: 14px; font-weight: bold; color: #333; text-decoration: none; margin-bottom: 10px; display: inline-block;">
                                            Product Details
                                        </a>
                                        <form action="{{url('add_cart', $product->id)}}" method="Post" style="display: flex; flex-direction: column; gap: 10px; margin-top: 10px;">
                                            @csrf
                                            <!-- Quantity Input -->
                                            <input type="number" 
                                                   value="1" 
                                                   name="quantity" 
                                                   min="1" 
                                                   style="width: 80px; height: 40px; text-align: center; border: 1px solid #ccc; border-radius: 4px; padding: 5px; font-size: 16px;">
                                            
                                            @if($product->category != 'Jewellery')
                                            <!-- Color Selection -->
                                            <select name="color" 
                                                    style="height: 40px; width: 100%; border: 1px solid #ccc; border-radius: 4px; padding: 5px; font-size: 16px;">
                                                <option value="" disabled selected>Select Color</option>
                                                @if(!empty($product->color))
                                                    @foreach(json_decode($product->color, true) ?? [] as $color)
                                                        <option value="{{ $color }}">{{ $color }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @endif

                                            <!-- Size Selection -->
                                            <select name="size" 
                                                    style="height: 40px; width: 100%; border: 1px solid #ccc; border-radius: 4px; padding: 5px; font-size: 16px;">
                                                <option value="" disabled selected>Select Size</option>
                                                @if(!empty($product->size))
                                                    @foreach(json_decode($product->size, true) ?? [] as $size)
                                                        <option value="{{ $size }}">{{ $size }}</option>
                                                    @endforeach
                                                @endif
                                            </select>

                                            <!-- Add to Cart Button -->
                                            <button type="submit" 
                                                    style="background-color: #28a745; color: #fff; font-size: 16px; font-weight: bold; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; transition: background-color 0.3s;">
                                                Add to Cart
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="img-box" style="display: flex; justify-content: center; align-items: center; height: 250px; background-color: #f8f9fa;">
                                    <img src="product/{{$product->image}}" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                </div>
                                <div class="detail-box" style="padding: 15px; text-align: center;">
                                    <h5 style="font-size: 18px; color: #333; margin-bottom: 10px;">
                                        {{$product->title}}
                                    </h5>
                                    @if($product->discount_price != null)
                                    <h6 style="font-size: 16px; color: #e74c3c; text-decoration: line-through;">
                                        ${{$product->price}}
                                    </h6>
                                    <h6 style="font-size: 18px; color: #28a745; font-weight: bold;">
                                        ${{$product->discount_price}}
                                    </h6>
                                    @else
                                    <h6 style="font-size: 18px; color: #333;">
                                        ${{$product->price}}
                                    </h6>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <span style="padding-top: 20px;">
                        {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
                    </span>
                </div>
            </div>
        </section>
         <!-- end product section -->
 
         <!-- footer start -->
         @include('home.footer')
         <!-- footer end -->
         <div class="cpy_">
            <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
            
               Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
            
            </p>
         </div>
      </div>
      <!-- jQuery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>
