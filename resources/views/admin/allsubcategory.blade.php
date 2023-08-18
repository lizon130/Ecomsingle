@extends("admin.layouts.template")
@section('page_title')
    All Sub Category - SingleEcom
@endsection
@section('content')
                      <!-- Bootstrap Table with Header - Light -->
                      <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Page/</span> ALL Sub-Category </h4>                  
            <div class="card">
            <h5 class="card-header">Available Sub-Category</h5>
            @if(Session()->has('message'))
            <div class="alert alert-success">
              {{ Session()->get('message') }}
            </div>
  
          @endif  
            <div class="table-responsive text-nowrap">
              <table class="table">
                <thead class="table-light">
                  <tr>
                    <th>ID</th>
                    <th>Sub category name</th>
                    <th>category</th>
                    <th>product</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                  @foreach ($allsubcategories as $subcategory)
                      
                    <tr>
                        <td>{{$subcategory->id}}</td>
                        <td>{{$subcategory->subcategory_name}}</td>
                        <td>{{$subcategory->category_name}}</td>
                        <td>{{$subcategory->product_count}}</td>
                        <td>
                            <a href="{{route('editsubcat', $subcategory->id)}}" class="btn btn-primary">Edit</a>

                            <a href="{{route('deletesubcat', $subcategory->id)}}" class="btn btn-warning">Delete</a>
                        </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
@endsection