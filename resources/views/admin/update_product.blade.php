<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')
    <style>
        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }
        label {
            display: inline-block;
            width: 250px;
            font-size: 18px !important;
            color: white !important;
        }
        textarea{
            width: 450px;
            height: 100px;
        }
        input[type='text'] {
            width: 350px;
            height: 50px;
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
                <h1>Update Product</h1>
                <div class="div_deg">
                    <form action="{{ url('edit_product', $data->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input_deg">
                            <label for="">Product Title</label>
                            <input type="text" name="title" value="{{ $data->title }}" required>
                        </div>
                        <div class="input_deg">
                            <label for="">Description</label>
                            <textarea name="description" required>{{ $data->description }}</textarea>
                        </div>
                        <div class="input_deg">
                            <label for="">Price</label>
                            <input type="text" name="price" value="{{ $data->price }}" required>
                        </div>

                        <div class="input_deg">
                            <label for="">Quantity</label>
                            <input type="text" name="quantity" value="{{ $data->quantity }}">
                        </div>

                        <div class="input_deg">
                            <label for="">Category</label>
                            <select name="category" required>
                                <option value="{{ $data->category }}">{{ $data->category }}</option>
                                @foreach ($category as $categorys)
                                <option value="{{ $categorys->category_name }}">{{ $categorys->category_name }}</option>

                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="">Current Image</label>
                            <img src="/products/{{ $data->image }}" width="150px">
                        </div>
                        <div>
                            <label for="">Change Image</label>
                            <input type="file" name="image">
                        </div>

                        <div>
                            <input type="submit" class="btn btn-success" value="Update Product">
                        </div>
                    </form>
                </div>
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
