<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Details</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            color: #333;
            background-color: #f4f4f9;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
            color: #444;
        }
        .header p {
            font-size: 14px;
            color: #777;
        }
        .order-details h2 {
            font-size: 22px;
            color: #555;
            border-bottom: 2px solid #f4f4f9;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        .order-details table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-details table th, 
        .order-details table td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ddd;
        }
        .order-details table th {
            background-color: #f9f9f9;
            color: #555;
            font-weight: bold;
        }
        .order-details table td {
            background-color: #fff;
        }
        .order-details img {
            max-width: 100%; /* Ensures the image fits within its container */
            height: auto; /* Maintains the aspect ratio */
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 5px;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #888;
        }
        .highlight {
            color: #007bff;
            font-weight: bold;
        }
        .btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            font-size: 14px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Order Confirmation</h1>
            <p>Thank you for your purchase, <span class="highlight">{{$order->name}}</span>!</p>
        </div>
        <div class="order-details">
            <h2>Order Summary</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <td>{{$order->name}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{$order->email}}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{$order->address}}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{$order->phone}}</td>
                </tr>
                <tr>
                    <th>Product Title</th>
                    <td>{{$order->product_title}}</td>
                </tr>
                <tr>
                    <th>Quantity</th>
                    <td>{{$order->quantity}}</td>
                </tr>
                <tr>
                    <th>Price</th>
                    <td>${{$order->price}}</td>
                </tr>
                <tr>
                    <th>Color</th>
                    <td>{{$order->color}}</td>
                </tr>
                <tr>
                    <th>Size</th>
                    <td>{{$order->size}}</td>
                </tr>
                <tr>
                    <th>Payment Status</th>
                    <td class="highlight">{{$order->payment_status}}</td>
                </tr>
                <tr>
                    <th>Delivery Status</th>
                    <td>{{$order->delivery_status}}</td>
                </tr>
                <tr>
                    <th>Product Image</th>
                    <td>
                        <img src="product/{{$order->image}}">
                    </td>
                </tr>
            </table>
        </div>
        <div class="footer">
            <p>&copy; 2025 Famms Store. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
