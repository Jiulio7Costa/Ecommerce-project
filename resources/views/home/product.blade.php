<section class="product_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2 style="font-size: 36px; color: #333;">
                Our Products
            </h2>

            <div style="display: flex; justify-content: center; margin: 1rem 0;">
                <form action="{{url('product_search')}}" method="GET" style="display: flex; gap: 0.5rem;">
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
            @foreach($product as $products)
            <div class="col-sm-6 col-md-4 col-lg-4">
                <div class="box" style="border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); overflow: hidden; background-color: #fff;">
                    <div class="option_container" style="padding: 15px; background-color: #f8f9fa;">
                        <div class="options">
                            <a href="{{url('product_details', $products->id)}}" 
                               class="option1" 
                               style="font-size: 14px; font-weight: bold; color: #333; text-decoration: none; margin-bottom: 10px; display: inline-block;">
                                Product Details
                            </a>
                            <form action="{{url('add_cart', $products->id)}}" method="Post" style="display: flex; flex-direction: column; gap: 10px; margin-top: 10px;">
                                @csrf
                                <!-- Quantity Input -->
                                <input type="number" 
                                       value="1" 
                                       name="quantity" 
                                       min="1" 
                                       style="width: 80px; height: 40px; text-align: center; border: 1px solid #ccc; border-radius: 4px; padding: 5px; font-size: 16px;">
                                
                                @if($products->category != 'Jewellery')
                                <!-- Color Selection -->
                                <select name="color" 
                                        style="height: 40px; width: 100%; border: 1px solid #ccc; border-radius: 4px; padding: 5px; font-size: 16px;">
                                    <option value="" disabled selected>Select Color</option>
                                    @if(!empty($products->color))
                                        @foreach(json_decode($products->color, true) ?? [] as $color)
                                            <option value="{{ $color }}">{{ $color }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @endif

                                <!-- Size Selection -->
                                <select name="size" 
                                        style="height: 40px; width: 100%; border: 1px solid #ccc; border-radius: 4px; padding: 5px; font-size: 16px;">
                                    <option value="" disabled selected>Select Size</option>
                                    @if(!empty($products->size))
                                        @foreach(json_decode($products->size, true) ?? [] as $size)
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
                        <img src="product/{{$products->image}}" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                    </div>
                    <div class="detail-box" style="padding: 15px; text-align: center;">
                        <h5 style="font-size: 18px; color: #333; margin-bottom: 10px;">
                            {{$products->title}}
                        </h5>
                        @if($products->discount_price != null)
                        <h6 style="font-size: 16px; color: #e74c3c; text-decoration: line-through;">
                            ${{$products->price}}
                        </h6>
                        <h6 style="font-size: 18px; color: #28a745; font-weight: bold;">
                            ${{$products->discount_price}}
                        </h6>
                        @else
                        <h6 style="font-size: 18px; color: #333;">
                            ${{$products->price}}
                        </h6>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            <span style="padding-top: 20px;">
            {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
            </span>
        </div>
    </div>
</section>
