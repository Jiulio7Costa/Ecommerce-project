<!DOCTYPE html>
<html lang="en">
<head>
    <base href='/public'>
    @include('admin.css')
    <style type="text/css">
        .form-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h1 {
            text-align: center;
            font-size: 36px;
            margin-bottom: 30px;
            color: #333;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            font-size: 16px;
            padding: 8px 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            color: #000;
            background: #fff;
        }

        .form-group input[type="checkbox"] {
            width: auto;
            margin-right: 10px;
        }

        .form-group .checkbox-label {
            display: inline-flex;
            align-items: center;
            margin-right: 15px;
            color: #333;
        }

        .form-group input[type="file"] {
            border: none;
        }

        .editor-container {
            width: 100%;
            max-height: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            font-size: 16px;
            background: #f9f9f9;
            color: #333;
            overflow-y: auto;
            white-space: pre-wrap;
            resize: vertical;
        }

        .toolbar {
            margin-bottom: 10px;
            display: flex;
            gap: 10px;
            padding: 5px;
            background-color: #f1f1f1;
            border-radius: 4px;
        }

        .toolbar button {
            padding: 5px 10px;
            font-size: 16px;
            cursor: pointer;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f0f0f0;
            color: #333;
        }

        .toolbar button:hover {
            background-color: #ddd;
        }

        .btn-primary {
            width: 100%;
            padding: 10px 15px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .product-price {
            font-size: 18px;
            font-weight: bold;
            color: white;
        }
    </style>
</head>
<body>
<div class="container-scroller">
    @include('admin.sidebar')
    @include('admin.header')
    <div class="main-panel">
        <div class="content-wrapper">

            @if(session()->has('message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                {{ session()->get('message') }}
            </div>
            @endif

            <div class="form-container">
                <h1>Add Product</h1>
                <form action="{{ url('update_product_confirm',$product->id) }}" method="POST" enctype="multipart/form-data" onsubmit="submitForm()">
                    @csrf
                    <div class="form-group">
                        <label for="title">Product Title:</label>
                        <input type="text" id="title" name="title" placeholder="Write a title" required value="{{$product->title}}">
                    </div>

                    <div class="form-group">
                        <label for="description">Product Description:</label>
                        <div class="toolbar">
                            <button type="button" onclick="formatText('bold')"><b>Bold</b></button>
                            <button type="button" onclick="formatText('italic')"><i>Italic</i></button>
                            <button type="button" onclick="formatText('underline')"><u>Underline</u></button>
                            <button type="button" onclick="resetFormatting()">Normal Text</button>
                        </div>
                        <div id="description" class="editor-container" contenteditable="true" placeholder="Write a description">
                            {!! $product->description !!}
                        </div>
                    </div>

                    <input type="hidden" id="description-input" name="description">

                    <div class="form-group">
                        <label for="price">Product Price:</label>
                        <input type="number" id="price" name="price" placeholder="Give a price" required value="{{$product->price}}">
                    </div>

                    <div class="form-group">
                        <label for="discount_price">Product Discount Price:</label>
                        <input type="number" id="discount_price" name="discount_price" placeholder="Discount price" value="{{$product->discount_price}}">

                    </div>

                    <div class="form-group">
                        <label for="quantity">Product Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="0" placeholder="Quantity" required value="{{$product->quantity}}">
                    </div>

                    <div class="form-group">
                        <label for="category">Product Category:</label>
                        <select id="category" name="category" required>
                            <!-- Keep the previous category selected if no new selection is made -->
                            <option value="{{ $product->category }}" selected>{{ $product->category }}</option>
                            @foreach($category as $categoryItem)
                                <option value="{{ $categoryItem->category_name }}" 
                                    {{ $categoryItem->category_name == $product->category ? 'selected' : '' }}>
                                    {{ $categoryItem->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">Current Product Image:</label>
                        <img height="100" width="100" src="/product/{{$product->image}}">
                    </div>

                    <div class="form-group">
                        <label for="image">Change Product Image:</label>
                        <input type="file" id="image" name="image" >
                    </div>

                    <div class="form-group">
                        <label>Product Colors:</label>
                        @php
                            $selectedColors = json_decode($product->color) ?? [];  // Default to empty array if null
                        @endphp
                        <label class="checkbox-label">
                            <input type="checkbox" name="colors[]" value="red" 
                                {{ in_array('red', $selectedColors) ? 'checked' : '' }}> Red
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="colors[]" value="blue" 
                                {{ in_array('blue', $selectedColors) ? 'checked' : '' }}> Blue
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="colors[]" value="green" 
                                {{ in_array('green', $selectedColors) ? 'checked' : '' }}> Green
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="colors[]" value="black" 
                                {{ in_array('black', $selectedColors) ? 'checked' : '' }}> Black
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="colors[]" value="white" 
                                {{ in_array('white', $selectedColors) ? 'checked' : '' }}> White
                        </label>
                    </div>
                    

                    <div class="form-group">
                        <label>Product Sizes:</label>
                        @php
                            $selectedSizes = json_decode($product->size) ?? [];  // Default to empty array if null
                        @endphp
                        <label class="checkbox-label">
                            <input type="checkbox" name="sizes[]" value="S" 
                                {{ in_array('S', $selectedSizes) ? 'checked' : '' }}> S
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="sizes[]" value="M" 
                                {{ in_array('M', $selectedSizes) ? 'checked' : '' }}> M
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="sizes[]" value="L" 
                                {{ in_array('L', $selectedSizes) ? 'checked' : '' }}> L
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="sizes[]" value="XL" 
                                {{ in_array('XL', $selectedSizes) ? 'checked' : '' }}> XL
                        </label>
                        <label class="checkbox-label">
                            <input type="checkbox" name="sizes[]" value="XXL" 
                                {{ in_array('XXL', $selectedSizes) ? 'checked' : '' }}> XXL
                        </label>
                    </div>
                    

                    <div class="form-group product-price">
                        <label for="price-display">Product Price: </label>
                        <span id="price-display">$0</span>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.script')

<script>
    function formatText(command) {
        document.execCommand(command, false, null);
    }

    function resetFormatting() {
        const editor = document.getElementById('description');
        editor.focus();
        document.execCommand('removeFormat');
    }

    function updatePrice() {
        const selectedColors = document.querySelectorAll('input[name="colors[]"]:checked');
        const selectedSizes = document.querySelectorAll('input[name="sizes[]"]:checked');
        
        let basePrice = 50; // Base price

        // Add price based on selected colors
        if (selectedColors.length > 0) {
            basePrice += selectedColors.length * 10; // $10 per color
        }

        // Add price based on selected sizes
        if (selectedSizes.length > 0) {
            basePrice += selectedSizes.length * 5; // $5 per size
        }

        document.getElementById('price-display').textContent = `$${basePrice}`;
    }

    function submitForm() {
        const descriptionContent = document.getElementById('description').innerHTML;
        document.getElementById('description-input').value = descriptionContent;
    }
</script>
</body>
</html>
