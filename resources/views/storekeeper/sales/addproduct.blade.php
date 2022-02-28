@extends('layouts.appstore')

@section('content')
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        {{-- <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Register New Product</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/storekeeper">Home</a></li>
                <li class="breadcrumb-item active">Product</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header --> --}}

        <!-- Main content -->
        <section class="content">
        <div class="container-fluid"><br><br>
            <!-- Small boxes (Stat box) -->
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            {{ __('Register New Product') }}
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <section class="content">
                                <div class="container-fluid">
                                    <form method="POST" action="#" id="calculate">
                                        @csrf
                                        <input type="text" name="sale_id" value="{{ $sale->id }}">
                                        <div class="form-group row">
                                            <label for="product" class="col-md-4 col-form-label text-md-right">{{ __('Product Item') }}</label>
                
                                            <div class="col-md-6">
                                                @if ($products)
                                                    <select name="product" id="product" class="form-control">
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}">{{ $product->name }} | {{ $product->description }} | TZS {{ number_format($product->price) }}</option>
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
                                                <input id="qty" type="number" class="form-control" name="qty" value="" required>
                
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
                                                <input id="amount" type="number" class="form-control" name="amount" oninput="add_number()" disabled>
                
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
            <!-- /.row (main row) -->
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
@endsection