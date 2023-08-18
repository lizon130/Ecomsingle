@extends('user_template.layouts.template')

@section('main-content')
 <h1> Final Step to place your Order </h1>
 <div class="row">
    <div class="col-12">
        <div class="col-6">
            <div class="box_main">
                <h3>product will send at- </h3>
                <p>Phone number- {{$shipping_add->phone_number}}</p>
                <p>City/Village- {{$shipping_add->city_name}}</p>
                <p>Postal Code- {{$shipping_add->postal_code}}</p>
            </div>
        </div>

        <div class="col-6">
            <div class="box_main">
           <H3> Your final products are-</H3> 
            <div class="table-responsive">
                <table class="table">
                  <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                  </tr>
        
                  @php
                      $total =0;
                  @endphp
        
                  @foreach ($cart_items as $item)
                      <tr>
                      @php
                        $product_name = App\Models\Product::where('id',$item->product_id)->value('product_name');
        
                        $img= App\Models\Product::where('id',$item->product_id)->value('product_img');
                      @endphp
                        <td>{{$product_name}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{$item->price}}</td>
                      </tr>
        
                    @php
                      $total = $total + $item->price;
                    @endphp
                  @endforeach
                    
                  <tr>
                    <td></td>
                    <td>Total Price-</td>
                    <td>{{$total}}/=</td>
                  </tr>   
                </table>
              </div>
            </div>
        </div>    
    </div>

    <form action="" method="post">
      @csrf
    <input type="submit" value="Cancel order" class="btn btn-danger mr-3">
    </form>

    <form action="{{route('placeorder')}}" method="post">
      @csrf
      <input type="submit" value="Place order"  class="btn btn-primary">
    </form>

 </div>
@endsection