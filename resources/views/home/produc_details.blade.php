<!DOCTYPE html>
<html>

<head>
@include('home.css')
</head>
<style>
    .div_center{
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px;
    }
    .detail-box{
        padding: 15px;
    }
</style>
<body>
  <div class="hero_area">
@include('home.header')
</div>
<section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Latest Products
        </h2>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="box">

              <div class="div_center" >
                <img width="400px" src="/products/{{ $data->image }}" alt="">
              </div>
              <div class="detail-box">
                <h6>Title :-{{ $data->title }}</h6>
                <h6>Price :-<span>{{ $data->price }}</span></h6>
              </div>
              <div class="detail-box">
                <h6>Category :-{{ $data->category }}</h6>
                <h6>Quantity :-<span>{{ $data->quantity }}</span></h6>
              </div>
              <div class="detail-box">
                <p>Description :-{{ $data->description }}</p>

              </div>
              <div class="detail-box">
                <a href="{{ url('add_cart', $data->id) }}" class="btn btn-primary">Add to Cart</a>

              </div>
              {{-- <div style="padding: 15px">
                <a href="{{ url('produc_details',$data->id) }}" class="btn btn-danger" >Details</a>
              </div> --}}
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('home.footer')

</body>

</html>
