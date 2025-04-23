<!DOCTYPE html>
<html>
  <head>
    <!-- Toastr CSS -->

<!-- Toastr JS -->

    @include('admin.css')
    <style type="text/css">
        input[type='text']{
            width: 400px;
            height:50px;
        }
        .div_deg{
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px;
        }
        .table_beg{
            text-align: center;
            margin: auto;
            border: 2px solid yellowgreen;
            margin-top: 50px;
            width: 600px;
        }
        th{
            background: skyblue;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            color: white
        }
        td{
            color: white;
            padding: 10px;
            border: 1px solid skyblue;
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
            <h1 style="color: white">Add Category</h1>
            <div class="div_deg">
            <form action="{{ url('add_category') }}" method="post">
                @csrf
                <div>
                    <input type="text" name="category">

                    <input type="submit" class="btn btn-primary" value="Add Category">
                </div>
                <p></p>
            </form>
            </div>
                <div>
                    <table class="table_beg">
                        <tr>
                            <th>Category Name</th>
                            <th>Delete</th>
                            <th>Edit</th>
                        </tr>
                        @foreach ($data as $datas)

                        <tr>
                            <td>{{ $datas->category_name }}</td>
                            <td>
                                <a class="btn btn-success"href="{{ url('edit_category', $datas->id) }}">Edit</a>

                            </td>
                            <td>
                                <a class="btn btn-danger" onclick="confirmation(event)" href="{{ url('delete_category', $datas->id) }}">Delete</a>

                            </td>
                        </tr>

                        @endforeach
                    </table>
                </div>
            </div>
            {{-- {{ $datas->links() }} --}}
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
