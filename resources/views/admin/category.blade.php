<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    @include('admin.css')
    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .h2_font {
            font-size: 45px;  /* Increased font size for better visibility */
            padding-bottom: 40px;
            color: #fff;  /* White color for the title */
        }

        .input_color {
            color: black;  /* Black text for input fields */
            padding: 12px 20px;  /* Added padding for better text spacing */
            font-size: 18px;  /* Slightly larger font size for better readability */
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 60%;  /* Adjusted the width to 60% for better sizing */
            margin-bottom: 20px;
            background-color: #f9f9f9;  /* Light background for input fields */
        }

        .center {
            margin: auto;
            width: 80%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            background-color: #f9f9f9;  /* Light background color */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        td {
            background-color: #ffffff;
            color: #333;  /* Black text for table cells */
        }

        td a {
            color: white;  /* White text for delete link */
            background-color: #dc3545;  /* Red background for delete button */
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        td a:hover {
            background-color: #c82333;  /* Darker red on hover */
        }

        .btn {
            padding: 8px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
    </style>
</head>
<body>
<div class="container-scroller">
    @include('admin.sidebar')
    @include('admin.header')

    <div class="main-panel">
        <div class="content-wrapper">
            <!-- Success Message -->
            @if(session()->has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('message') }}
                </div>
            @endif

            <!-- Add Category Form -->
            <div class="div_center">
                <h2 class="h2_font">Add Category</h2>
                <form action="{{url('add_category')}}" method="POST">
                    @csrf
                    <input class="input_color" type="text" name="category" placeholder="Write category name" required>
                    <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                </form>
            </div>

            <!-- Categories Table -->
            <div class="center">
                <table>
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $data)
                            <tr>
                                <td>{{ $data->category_name }}</td>
                                <td>
                                    <a onclick="return confirm('Are you sure you want to delete this category?')" 
                                       class="btn btn-danger" 
                                       href="{{url('delete_Category', $data->id)}}">
                                       Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('admin.script')
</body>
</html>
