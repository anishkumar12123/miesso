<!DOCTYPE html>
<html>

<head>
    @include('home.css')
    <style>
        .div_deg {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 60px;
        }

        table {
            border: 2px solid black;
            text-align: center;
            width: 800px;
        }

        th {
            border: 2px solid black;
            text-align: center;
            color: white;
            font: 20px;
            font-weight: 20px;
            background: black;
        }

        td {
            border: 2px solid skyblue;
        }

        .cart_value {
            text-align: center;
            margin-bottom: 70px;
            padding: 18px;
        }

        .order_deg {
            padding-right: 150px;
            margin-top: -50px;
            display: flex;
            text-align: center;
            justify-content: center;
        }

        label {
            display: inline-block;
            width: 100px;
        }

        .div_gap {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        @include('home.header')



    </div>
    <div class="div_deg">



        <table>
            <tr>
                <th>Product Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Remove</th>
            </tr>
            <?php
            $value = 0;
            ?>
            @foreach ($cart as $carts)
                <tr>
                    <td>{{ $carts->product->title }}</td>
                    <td>{{ $carts->product->price }}</td>
                    <td><img width="150px" src="/products/{{ $carts->product->image }}" alt=""></td>
                    <td><a class="btn btn-danger" href="{{ url('delete_cart', $carts->id) }}">Remove</a></td>


                </tr>
                <?php

                $value = $value + $carts->product->price;

                ?>
            @endforeach

        </table>

    </div>
    <div class="cart_value">
        <h3>Total Value of Cart is ${{ $value }}</h3>
    </div>

    <div class="order_deg">
        <form action="{{ url('comfirm_order') }}" method="post">
            @csrf
            <div class="div_gap">
                <label> Receiver Name</label>
                <input type="name" name="name" value="{{ Auth::user()->name }}">
            </div>
            <div class="div_gap">
                <label> Receiver Address</label>
                <textarea type="text" name="address">{{ Auth::user()->address }}</textarea>
            </div>
            <div class="div_gap">
                <label> Receiver Phone</label>
                <input type="text" name="phone" value="{{ Auth::user()->phone }}">
            </div>
            <div class="div_gap">
                <input type="submit" class="btn btn-primary" value="Cash On Delivery ">
                <a class="btn btn-success" href="{{ url('stripe',$value) }}">Pay Using Card</a>
            </div>

        </form>
    </div>



    @include('home.footer')

</body>

</html>
