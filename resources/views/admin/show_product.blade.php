<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('admin.css')

    <style>
        .table-container {
            margin: 40px auto;
            width: 80%;
            border: 2px solid #fff;
            background-color: #f8f9fa;
            border-radius: 8px;
            overflow-x: auto; /* Enable horizontal scrolling */
        }

        .table-title {
            text-align: center;
            font-size: 2.5rem;
            margin-top: 20px;
            color: #fdf9f9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            color: #333; /* Dark text color for better visibility */
            word-wrap: break-word; /* Allow content to break across lines if necessary */
        }

        table th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:nth-child(odd) {
            background-color: #fff;
        }

        /* Make the description column wider */
        table th:nth-child(2), /* Header of description column */
        table td:nth-child(2) { /* Cells of description column */
            width: 250px;  /* Adjust this width to fit longer text */
            text-align: left;  /* Align text to the left for better readability */
            white-space: normal; /* Allow line breaks */
            overflow: hidden;  /* Prevent overflow outside the cell */
            word-wrap: break-word; /* Wrap long words within the cell */
        }

        /* Adjusting the width for the action columns */
        table th:nth-child(10),
        table td:nth-child(10),
        table th:nth-child(11),
        table td:nth-child(11) {
            width: 120px; /* Set an appropriate width for these columns */
        }

        /* Image size adjustments for better display */
        .img_size {
            width: 100px; /* Adjust the width to fit your layout */
            height: auto; /* Maintain aspect ratio */
            max-width: 150px; /* Max width for larger images */
        }

        /* Button style for Edit and Delete */
        .btn {
            padding: 5px 10px;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            width: 100%;  /* Make buttons full width inside the cells */
        }

        .btn-danger {
            background-color: #dc3545; /* Red background for Delete */
        }

        .btn-success {
            background-color: #28a745; /* Green background for Edit */
        }

        .btn:hover {
            opacity: 0.8;
        }
    </style>
    
</head>
<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        @include('admin.header')

        <!-- main content -->
        <div class="main-panel">
            <div class="content-wrapper">

                @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
            @endif


                <h2 class="table-title">All Products</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Discount Price</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Product Image</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($product as $product)

                            <tr>
                                <td>{{$product->title}}</td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->category}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->discount_price}}</td>
                                <td>{{$product->color}}</td>
                                <td>{{$product->size}}</td>
                                <td>
                                    <img class="img_size" src="/product/{{$product->image}}" alt="Product Image">
                                </td>
                                <td>
                                    <a class="btn btn-danger" onclick="return confirm('Are you sure to delete this?')" href="{{url('delete_product',$product->id)}}">Delete</a>
                                </td> 
                                <td>
                                    <a class="btn btn-success" href="{{url('update_product',$product->id)}}">Edit</a>
                                </td> 
                            </tr>

                            @endforeach

                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>
</html>
