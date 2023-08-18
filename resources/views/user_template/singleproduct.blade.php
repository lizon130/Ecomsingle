@extends('user_template.layouts.template')

@section('main-content')

<div class="container">
    <div class="col-lg-4">
        <div class="box_main">
            <div class="tshirt_img"><img src="{{asset($product->product_img)}}" alt=""></div>
        </div>
    </div>

    <div class="col-lg-8">
       
        <div class="box_main">
            <div class="product-info">
                <h4 class="text text-left">{{$product->product_name}}</h4>
                <p class="price text-left"> price <span style="color: #262626;">$ {{$product->price}}</span> </p>
            </div>
    
            <div class="my-3 product-details">
                <p class="lead">{{$product->product_long_des}}</p>
                <ul class="p-2 bg-light my-2">
                    <li>Category Name: {{$product->product_category_name}}</li>
                    <li>Sub Category Name: {{$product->product_subcategory_name}}</li>
                    <li>Available: {{$product->quantity}}</li>
                </ul>

                <div class="add-to-cart-btn">
                    <form action="{{route('addproductTocart')}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$product->id}}" name="product_id">
                        <input type="hidden" value="{{$product->price}}" name="price">
                        <input type="hidden" value="1" name="quantity">
                       
                        <div class="form-group">
                            <label for="quantity">How many pieces are Available</label>
                            <input class="form-control" type="number" min='1' name="product_quantity">
                        </div>

                        <input class="btn essence-btn" type="submit" value="Add To Cart">
                    </form>
                </div>

            </div>
        </div>

    </div>

    <section class="new_arrivals_area section-padding-80 clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading text-center">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
        </div>

    <div class="container">
        <div class="row justify-content-center"> <!-- Added justify-content-center class -->
           
            @foreach ($related_products as $product)
            <div class="col-12 col-md-6 col-lg-4"> <!-- Adjusted column width for responsiveness -->
                <div class="single-product-wrapper">
                    <div class="product-img">
                        <img src="{{ asset($product->product_img) }}" alt="">
                    </div>
                    <div class="product-description">
                        <a href="single-product-details.html">
                            <h6>{{ $product->product_name }}</h6>
                        </a>
                        <p class="product-price">${{ $product->price }}</p>

                        <div class="seemore_btn">
                            <a href="{{route('singleproduct',[$product->id, $product->slug])}}">See More</a>
                        </div>

                        <div class="add-to-cart-btn">
                            <form action="{{route('addproductTocart')}}" method="POST">
                                @csrf
                                <input type="hidden" value="{{$product->id}}" name="product_id">
                                <input type="hidden" value="{{$product->price}}" name="price">
                                <input type="hidden" value="1" name="quantity">
                               
                                <div class="form-group">
                                    <label for="quantity">How many pieces are Available</label>
                                    <input class="form-control" type="number" min='1' name="product_quantity">
                                </div>
        
                                <input class="btn essence-btn" type="submit" value="Add To Cart">
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
    </div>

</div>

@endsection