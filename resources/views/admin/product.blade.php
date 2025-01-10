<!DOCTYPE html>
<html lang="en">
<head>
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
            color: black;
        }

        .price-details {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
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
                <form action="{{ url('add_product') }}" method="POST" enctype="multipart/form-data" onsubmit="submitForm()">
                    @csrf
                    <div class="form-group">
                        <label for="title">Product Title:</label>
                        <input type="text" id="title" name="title" placeholder="Write a title" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Product Description:</label>
                        <div class="toolbar">
                            <button type="button" onclick="formatText('bold')"><b>Bold</b></button>
                            <button type="button" onclick="formatText('italic')"><i>Italic</i></button>
                            <button type="button" onclick="formatText('underline')"><u>Underline</u></button>
                            <button type="button" onclick="resetFormatting()">Normal Text</button>
                        </div>
                        <div id="description" class="editor-container" contenteditable="true" placeholder="Write a description"></div>
                    </div>

                    <input type="hidden" id="description-input" name="description">

                    <div class="form-group">
                        <label for="price">Product Price:</label>
                        <input type="number" id="price" name="price" placeholder="Give a price" required oninput="updatePrice()">
                    </div>

                    <div class="form-group">
                        <label>Product Colors:</label>
                        @foreach(['Red', 'Blue', 'Green', 'Black', 'White'] as $color)
                        <label class="checkbox-label">
                            <input type="checkbox" name="colors[]" value="{{ strtolower($color) }}" onclick="updatePrice()"> {{ $color }}
                        </label>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label>Product Sizes:</label>
                        @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                        <label class="checkbox-label">
                            <input type="checkbox" name="sizes[]" value="{{ $size }}" onclick="updatePrice()"> {{ $size }}
                        </label>
                        @endforeach
                    </div>

                    <div class="form-group product-price">
                        <label for="price-display">Total Price:</label>
                        <span id="price-display">$0.00</span>
                        <div class="price-details">
                            Base price + $10 per color + $5 per size
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image">Product Image:</label>
                        <input type="file" id="image" name="image" required>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
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
        const basePrice = parseFloat(document.getElementById('price').value) || 0;
        const colorIncrement = 10;
        const sizeIncrement = 5;

        const totalPrice = basePrice + (selectedColors.length * colorIncrement) + (selectedSizes.length * sizeIncrement);
        document.getElementById('price-display').textContent = `$${totalPrice.toFixed(2)}`;
    }

    function submitForm() {
        const descriptionContent = document.getElementById('description').innerHTML;
        document.getElementById('description-input').value = descriptionContent;
    }
</script>
</body>
</html>
