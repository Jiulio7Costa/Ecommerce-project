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
          font-size: 45px;
          padding-bottom: 40px;
          color: #fff;
      }

      .table-container {
          margin: 40px auto;
          width: 90%;
          border: 2px solid #fff;
          background-color: #f8f9fa;
          border-radius: 8px;
          overflow-x: auto;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }

      table {
          width: 100%;
          border-collapse: collapse;
      }

      table thead tr {
          background-color: #343a40;
          color: #fff;
      }

      table th {
          text-align: left;
          padding: 12px;
          border: 1px solid #ddd;
          font-size: 16px; /* Larger, consistent text size */
      }

      table td {
          text-align: left;
          padding: 12px;
          border: 1px solid #ddd;
          color: #000;
          font-size: 16px; /* Keep consistent text size */
      }

      table tbody tr:nth-child(even) {
          background-color: #f2f2f2;
      }

      table tbody tr:hover {
          background-color: #e9ecef;
      }

      table img {
          max-width: 120px; /* Bigger image size */
          height: auto;
          border-radius: 6px; /* Rounded corners for a clean look */
          display: block;
          margin: 0 auto; /* Center align images */
      }

      /* Address and Phone spacing */
      table th:nth-child(3), /* Address */
      table td:nth-child(3) {
          width: 30%; /* Allocate more space for Address */
      }

      table th:nth-child(4), /* Phone */
      table td:nth-child(4) {
          width: 20%; /* Allocate more space for Phone */
      }

      /* Ensure long text wraps correctly */
      table th:nth-child(3),
      table td:nth-child(3),
      table th:nth-child(4),
      table td:nth-child(4) {
          white-space: normal;
          word-wrap: break-word;
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      @include('admin.sidebar')
      @include('admin.header')
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="div_center">
            <h2 class="h2_font">All Orders</h2>
            <div class="table-container">
              <table>
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone number</th>
                    <th>Product title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Payment status</th>
                    <th>Delivery status</th>
                    <th>Image</th>
                    <th>Delivered</th>
                    <th>Print PDF</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($order as $order)
                  <tr>
                    <td>{{$order->name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->product_title}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->color}}</td>
                    <td>{{$order->size}}</td>
                    <td>{{$order->payment_status}}</td>
                    <td>{{$order->delivery_status}}</td>
                    <td>
                      <img src="/product/{{$order->image}}" alt="Product Image">
                    </td>
                    <td>
                        @if($order->delivery_status=='processing')
                        <a href="{{url('delivered',$order->id)}}" onclick="return confirm('Are you sure this delivered !')" class="btn btn-primary">Delivered</a>
                        @else
                        <p style="color: green;">Delivered</p>
                        @endif
                    </td>

                    <td>
                      <a href="{{url('print_pdf',$order->id)}}" class="btn btn-info">Print PDF</a>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    @include('admin.script')
  </body>
</html>
