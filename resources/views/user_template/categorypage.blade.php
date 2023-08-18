@extends('user_template.layouts.template')

@section('main-content')
 
 <section class="new_arrivals_area section-padding-80 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <h2>{{$category->category_name}} - ({{$category->product_count}})</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center"> <!-- Added justify-content-center class -->
            @foreach ($products as $product)
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
</section>

@endsection