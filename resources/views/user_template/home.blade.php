@extends('user_template.layouts.template')

@section('main-content')
        <!-- ##### Welcome Area Start ##### -->
        <section class="welcome_area bg-img background-overlay" style="background-image: url('{{ asset('home/') }}/img/bg-img/bg-1.jpg');">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12">
                        <div class="hero-content">
                            <h2>All Products</h2>
                            <a href="#" class="btn essence-btn">view collection</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ##### Welcome Area End ##### -->
    
            <!-- ##### Top Catagory Area Start ##### -->
            <div class="top_catagory_area section-padding-80 clearfix">
                <div class="container">
                    <div class="row justify-content-center">

                        <!-- Single Catagory -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url({{ asset('home/') }}/img/bg-img/bg-2.jpg);">
                                <div class="catagory-content">
                                    <a href="#">Clothing</a>
                                </div>
                            </div>
                        </div>
                        <!-- Single Catagory -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url({{ asset('home/') }}/img/bg-img/bg-3.jpg);">
                                <div class="catagory-content">
                                    <a href="#">Shoes</a>
                                </div>
                            </div>
                        </div>
                        <!-- Single Catagory -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="single_catagory_area d-flex align-items-center justify-content-center bg-img" style="background-image: url({{ asset('home/') }}/img/bg-img/bg-4.jpg);">
                                <div class="catagory-content">
                                    <a href="#">Accessories</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ##### Top Catagory Area End ##### -->
    
            
        <!-- ##### CTA Area Start ##### -->
        <div class="cta-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cta-content bg-img background-overlay" style="background-image: url({{ asset('home/') }}/img/bg-img/bg-5.jpg);">
                            <div class="h-100 d-flex align-items-center justify-content-end">
                                <div class="cta--text">
                                    <h6>-60%</h6>
                                    <h2>Global Sale</h2>
                                    <a href="#" class="btn essence-btn">Buy Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ##### CTA Area End ##### -->
    
        <section class="new_arrivals_area section-padding-80 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-heading text-center">
                            <h2>Popular Products</h2>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="container">
                <div class="row justify-content-center"> <!-- Added justify-content-center class -->
                    @foreach ($allproducts as $product)
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
        </section>
        