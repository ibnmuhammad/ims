@extends('layouts.appstore')

@section('content')
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Products</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/storekeeper">Home</a></li>
                <li class="breadcrumb-item active">Products</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                {{-- container fluid start  --}}
                <div class="container-fluid">
                    {{-- card start  --}}
                    <div class="card">
                        {{-- card header --}}
                        <div class="card-header">
                            <h3 class="card-title">Products</h3>
                            <div class="btn btn-default float-right">
                                <a href="{{ route('products.create') }}">Add New Product</a>
                            </div>
                        </div>
                        {{-- card header end  --}}
                        {{-- card body start  --}}
                        <div class="card-body">
                            {{-- <div class="table-responsive"> --}}
                                <table class="table table-bordered table-hover" id="workerTable" cellspacing="0">
                                    <thead>
                                    <tr>
                                      <th>Product Category</th>
                                      <th>Product Name</th>
                                      <th>Product Description</th>
                                      <th>Product Price</th>
                                      <th>Product Stocks</th>
                                      {{-- <th>{{ __('Action') }}</th> --}}
                                      {{-- <th>{{ __('Action') }}</th> --}}
                                      <th>{{ __('Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($products)>0)
                                      @foreach ($products as $product)
                                      <tr>
                                        <td>{{ $product->category->name }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->description }}</td>
                                        <td>TZS {{ number_format($product->price) }}</td>
                                        <td>{{ $product->stock }}</td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="{{ route('product.newStock', $product->id) }}" title="Add New Stock">
                                                <i class="fas fa-plus">
                                                </i>
                                            </a>
                                            <a class="btn btn-info btn-sm" href="{{ route('products.edit', $product->id) }}" title="Change details">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                            </a>
                                            <a class="btn btn-danger btn-sm" onclick="return myFunction();">
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="form-inline">
                                                    @csrf
                                                    @method("DELETE")
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    <input type="submit" class="btn btn-danger btn-sm" value="Delete Product">
                                                </form>
                            
                                                <script>
                                                function myFunction() {
                                                    if(!confirm("Are You Sure you want to delete this?"))
                                                    event.preventDefault();
                                                }
                                                </script>
                                            </a>
                                        </td>
                                      </tr>
                                      @endforeach
                                    @endif 
                                    </tfoot>
                                  </table>
                            {{-- </div> --}}
                        </div>
                        {{-- card body end  --}}
                    </div>
                    {{-- card end  --}}
                </div>
                {{-- container fluid end  --}}
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    </div>
</div>
<!-- ./wrapper -->
@endsection