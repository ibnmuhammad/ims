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
                <h1 class="m-0">Order summary</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/storekeeper">Home</a></li>
                <li class="breadcrumb-item active">Order summary</li>
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
                            <h3 class="card-title">Order summary</h3>
                            {{-- Back to sales order list button  --}}
                            <div class="btn btn-danger float-right">
                                <a href="{{ route('sales.index') }}" style="color: white">Back to List</a>
                            </div>
                        </div>
                        {{-- card header end  --}}
                        {{-- card body start  --}}
                        <div class="card-body">
                            {{-- <div class="table-responsive"> --}}
                                <table class="table table-bordered" cellspacing="0">
                                    <thead>
                                    <tr>
                                      <th>Sale ID</th>
                                      <th>Date</th>
                                      <th>Client Name</th>
                                      <th>Client Phone-Number</th>
                                      <th>Products Purchased</th>
                                      <th>Total Amount</th>
                                      <th>Status</th>
                                      @if (!$sale->finalized_at)
                                        <th>Action</th>
                                      @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>{{ $sale->id }}</td>
                                        <td>{{ date('d-m-y', strtotime($sale->created_at)) }}</td>
                                        <td>{{ $sale->client }}</td>
                                        <td>{{ $sale->phonenumber }}</td>
                                        <td>{{ number_format($sale->soldproduct->sum('quantity')) }}</td>
                                        <td>TZS {{ number_format($sale->soldproduct->sum('total_amount')) }}</td>
                                        <td>
                                            {{-- {!! $sale->finalized_at ? 'Completed at<br>'.date('d-m-y', strtotime($sale->finalized_at)) : (($sale->products->count() > 0) ? 'TO FINALIZE' : 'ON HOLD') !!} --}}
                                            @if (!$sale->finalized_at)
                                                <span class="text-danger">On Hold</span>
                                            @else
                                                <span class="text-success">Finalized</span>
                                            @endif
                                        </td>
                                        @if (!$sale->finalized_at)
                                            <td>
                                                {{-- Finalize sale button  --}}
                                                {{-- <a class="btn btn-info btn-sm float-right" href="{{ route('sale.finalize', $sale->id) }}" title="Finalize Sale">
                                                    <i class="fas fa-tick">
                                                    </i>Finalize Sale
                                                </a> --}}
                                                <a class="btn btn-info btn-sm float-right" onclick="return myFunction();" title="Finalize Sale">
                                                    <form action="{{ route('sale.finalize', $sale->id) }}" method="POST" class="form-inline">
                                                        @csrf
                                                        {{-- @method("POST") --}}
                                                        <input type="submit" class="btn btn-info btn-sm" style="color: white" value="Finalize Sale">
                                                    </form>
                                
                                                    <script>
                                                    function myFunction() {
                                                        if(!confirm("Are you sure you want to finalize this sale?"))
                                                        event.preventDefault();
                                                    }
                                                    </script>
                                                </a>
                                            </td>
                                        @endif
                                      </tr>
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
            <div class="row">
                {{-- container fluid start  --}}
                <div class="container-fluid">
                    {{-- card start  --}}
                    <div class="card">
                        {{-- card header --}}
                        <div class="card-header">
                            <h3 class="card-title">Products Purchased</h3>
                            @if (!$sale->finalized_at)
                                    <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                                    Add Product
                                </button>
                                
                                
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <section class="content">
                                                <div class="container-fluid">
                                                    <form method="POST" action="{{ route('sale.addproduct', $sale->id) }}">
                                                        @csrf
                                                        <input type="hidden" name="sale_id" value="{{ $sale->id }}">
                                                        <div class="form-group row">
                                                            <label for="product" class="col-md-4 col-form-label text-md-right">{{ __('Product Item') }}</label>
                                
                                                            <div class="col-md-6">
                                                                @if ($products)
                                                                    <select name="product" id="product" class="form-control">
                                                                        @foreach ($products as $product)
                                                                            <option value="{{ $product->id }}">{{ $product->name }} | TZS {{ number_format($product->price) }} |In-stock {{ $product->stock }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                                @error('product')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                
                                                        <div class="form-group row">
                                                            <label for="qty" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>
                                
                                                            <div class="col-md-6">
                                                                <input id="qty" type="number" class="form-control" name="qty" oninput="add_number()" required>
                                
                                                                @error('qty')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                
                                                        <div class="form-group row">
                                                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                                
                                                            <div class="col-md-6">
                                                                <input id="price" type="number" class="form-control" name="price" oninput="add_number()" required>
                                
                                                                @error('price')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                
                                                        <div class="form-group row">
                                                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Total Amount') }}</label>
                                
                                                            <div class="col-md-6">
                                                                <input id="amount" type="number" class="form-control" name="amount" disabled>
                                
                                                                @error('amount')
                                                                    <span class="invalid-feedback" role="alert">
                                                                        <strong>{{ $message }}</strong>
                                                                    </span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                
                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-6 offset-md-4">
                                                                <button type="submit" class="btn btn-primary">
                                                                    {{ __('Add Product') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        {{-- card header end  --}}
                        {{-- card body start  --}}
                        <div class="card-body">
                            {{-- <div class="table-responsive"> --}}
                                <table class="table table-bordered table-hover" id="workerTable" cellspacing="0">
                                    <thead>
                                    <tr>
                                      <th>Product</th>
                                      <th>Quantity</th>
                                      <th>Price per Quantity (In TZS)</th>
                                      <th>Total Amount (In TZS)</th>
                                        @if (!$sale->finalized_at)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($sale->soldproduct as $sold)
                                        <tr>
                                            <td>{{ $sold->products->name }}</td>
                                            <td>{{ $sold->quantity }}</td>
                                            <td>{{ number_format( $sold->price ) }}</td>
                                            <td>{{ number_format($sold->total_amount) }}</td>
                                            @if (!$sale->finalized_at)
                                                <td>
                                                    <a class="btn btn-info btn-sm" href="{{ route('order.editprod', $sold->id) }}">
                                                        <i class="fas fa-pencil-alt">
                                                        </i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" onclick="return myFunction();">
                                                        <form action="{{ route('order.removeprod', $sold->id) }}" method="POST" class="form-inline">
                                                            @csrf
                                                            @method("DELETE")
                                                            <i class="fas fa-trash">
                                                            </i>
                                                            <input type="submit" class="btn btn-danger btn-sm" value="Remove Product">
                                                        </form>
                                    
                                                        <script>
                                                        function myFunction() {
                                                            if(!confirm("Are You Sure you want to delete this?"))
                                                            event.preventDefault();
                                                        }
                                                        </script>
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                      @endforeach
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
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    </div>
</div>
<!-- ./wrapper -->

<script>
    var text1 = document.getElementById("qty");
    var text2 = document.getElementById("price");

    function add_number() {
    var first_number = parseFloat(text1.value);
    if (isNaN(first_number)) first_number = 0;
    var second_number = parseFloat(text2.value);
    if (isNaN(second_number)) second_number = 0;
    var result = first_number * second_number;
    document.getElementById("amount").value = result;
    }
</script>

{{-- <script>
    var text1 = document.getElementById("qty1");
    var text2 = document.getElementById("price1");

    function add_number1() {
    var first_number = parseFloat(text1.value);
    if (isNaN(first_number)) first_number = 0;
    var second_number = parseFloat(text2.value);
    if (isNaN(second_number)) second_number = 0;
    var result = first_number * second_number;
    document.getElementById("amount1").value = result;
}
</script> --}}
@endsection