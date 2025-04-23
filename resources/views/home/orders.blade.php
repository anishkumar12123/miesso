<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('home.css')
    <style>
         th{
            background: #000;
            color: white;
        }
        td{
            padding: 10px;
            border: 1px solid rgb(111, 88, 88);
            /* background: rgb(162, 157, 157); */
            color: black;
        }
        .imag{
            width:150px ;
            height:100px ;
            margin-left: 20px
        }
    </style>
</head>

<body>

    <div class="hero_area">
        @include('home.header')

        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Delivery Status</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                @if ($order->isNotEmpty())
                @foreach ($order as $orders)
                <tr>
                    <td scope="row">{{ $orders->product->title }}</td>
                    <td>{{ $orders->product->price }}</td>
                    <td>{{ $orders->status }}</td>
                    <td><img class="imag" src="products/{{ $orders->product->image }}" alt=""></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>



    @include('home.footer');
</body>
</html>
