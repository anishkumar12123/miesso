<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
  </head>
  <style>
    .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }
        .table_deg{
            border: 2px solid greenyellow
        }
        th{
                background: skyblue;
                color: white;
                font-size: 20px;
                font-weight: bold;
                padding: 16px;
        }
        td{
            border: 1px solid skyblue;
            color: white;

        }
        .images{
            width: 150px;
            height: 150px;
        }
        input[type='search']{
                width: 500px;
                height: 60px;
                margin-left: 50px
        }
        h1{
            color: white;
            text-align: center;
            justify-content: center;
        }
  </style>
  <body>
    @include('admin.header')
@include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            <h1>Product View</h1>

            <form action="{{ url('search_product') }}" method="get">
            @csrf
                <input type="search" name="search">
                <input type="submit" class="btn btn-success" value="Search">
            </form>

            <div class="div_deg">
                <table class="table_deg">
                    <tr>
                        <th>Product Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    @foreach ($product as $products)

                    <tr>

                        <td>{{ $products->title }}</td>
                        <td>{{ $products->description }}</td>
                        <td>{{ $products->category }}</td>
                        <td>{{ $products->quantity }}</td>
                        <td>{{ $products->price }}</td>

                       <td> <img src="products/{{ $products->image }}" class="images"></td>
                       <td><a href=" {{ url('update_product',$products->slug) }}"  class="btn btn-success">Update</a></td>

                       <td><a href=" {{ url('delete_product',$products->id) }}"  onclick="confirmation(event)" class="btn btn-danger">Delete</a></td>

                        {{-- <td>,nb</td> --}}
                    </tr>
                    @endforeach

                </table>
            </div>

            <div class="div_deg">
                {{ $product->links() }}
            </div>


      </div>
    </div>
    <!-- JavaScript files-->
    <script>
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');

            swal({
                title: "Are you sure?",
                text: "This action will permanently delete the category.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    window.location.href = urlToRedirect;
                }
            });
        }

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
    integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
     crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
