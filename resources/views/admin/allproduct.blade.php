@extends("admin.layouts.template")
@section('page_title')
    All Product - SingleEcom
@endsection
@section('content')
     <!-- Bootstrap Table with Header - Light -->
     <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> ALL Product </h4>   
        
        @if(Session()->has('message'))
        <div class="alert alert-success">
          {{ Session()->get('message') }}
        </div>
      @endif  

<div class="card">  
<h5 class="card-header">Available Product</h5>
<div class="table-responsive text-nowrap">
<table class="table">
<thead class="table-light">
  <tr>
    <th>ID</th>
    <th>Product name</th>
    <th>Image</th>
    <th>product Price</th>
    <th>Actions</th>
  </tr>
</thead>
<tbody class="table-border-bottom-0">
  @foreach ($products as $product)
  <tr>
      <td>{{ $product->id }}</td>
      <td>{{ $product->product_name }}</td>
      <td>
          <img style="height:80px" src="{{asset($product->product_img)}}" alt="">
          <br>
          <a href="{{route('editproductimg',$product->id)}}" class="btn btn-primary">Update Image</a>
      </td>
      <td>{{ $product->price }}</td>
      <td>
          <a href="{{route('edit',$product->id)}}" class="btn btn-primary">Edit</a>
          <a href="{{route('deletepro',$product->id)}}" class="btn btn-warning">Delete</a>
      </td>
  </tr>
@endforeach

</tbody>
</table>
</div>
</div>
@endsection