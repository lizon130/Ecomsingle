@extends("admin.layouts.template")
@section('page_title')
    Pending Order - SingleEcom
@endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> Pending Orders </h4>   
   <div class="card">
    <div class="card-body">
    
            <table class="table">
                <tr>
                    <th>User ID</th>
                    <th>Shipping Info</th>
                    <th>Product ID</th>
                    <th>Quanity</th>
                    <th>Total Pay</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                @foreach ($pending_orders as $order)
                <tr>
                    <td>{{$order->user_id}}</td>
                    <td>
                        <ul>
                            <li>Phone Number- {{$order->shipping_phone_number}}</li>
                            <li>City- {{$order->shipping_city_name}}</li>
                            <li>Postal Code- {{$order->shipping_postal_code}}</li>
                        </ul>
                    </td>
                    <td>{{$order->product_id}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>{{$order->total_price}}</td>
                    <th>{{$order->status}}</th>
                    <td><a href="" class="btn btn-success"> Confirm Order</a></td>
                </tr>
                @endforeach

            </table>
</div>
    </div>
   </div>
@endsection