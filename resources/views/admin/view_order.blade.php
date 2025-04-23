<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
    <style>

        th{
            color: white;
        }
        td{
            padding: 10px;
            border: 1px solid gold;
            background: rgb(162, 157, 157);
            color: black;
        }
        .view{
            background: #000;
        }
    </style>
  </head>
  <body>
    @include('admin.header')
@include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h1 class="text-white">Order View</h1>
                <br>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>Customer Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Product Title</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Payment Status</th>
                                <th>Status</th>
                                <th>Change Status</th>
                                <th>Print PDF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data->isNotEmpty())
                                @foreach ($data as $datas)
                                    <tr>
                                        <td>{{ $datas->name }}</td>
                                        <td>{{ $datas->rec_address }}</td>
                                        <td>{{ $datas->phone }}</td>
                                        <td>{{ $datas->product->title }}</td>
                                        <td>{{ $datas->product->price }}</td>
                                        <td>
                                            <img width="100px" height="100px" src="/products/{{ $datas->product->image }}" alt="Product Image">
                                        </td>
                                        <td>
                                            {{ $datas->payment_status  }}
                                        </td>
                                        <td>
                                            @if ($datas->status == 'in progress')
                                                <h4 class="text-danger">{{ $datas->status }}</h4>
                                            @elseif ($datas->status == 'on_the_way')
                                                <h4 class="text-info">{{ $datas->status }}</h4>
                                            @elseif ($datas->status == 'delivered')
                                                <h4 class="text-success">{{ $datas->status }}</h4>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ url('on_the_way', $datas->id) }}">On the way</a>
                                            <a class="btn btn-success" href="{{ url('delivered', $datas->id) }}">Delivered</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-secondary" href="{{ url('print_pdf',$datas->id) }}" >Print PDF</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript files-->
    <script src="{{ asset('/admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ asset('/admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ asset('/admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('/admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('/admincss/js/front.js') }}"></script>
  </body>
</html>
