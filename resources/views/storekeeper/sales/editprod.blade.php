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
                <h1 class="m-0">Edit Product Order</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/storekeeper">Home</a></li>
                <li class="breadcrumb-item active">Edit Product Order</li>
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
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            {{ __('Edit Product Order') }}
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <section class="content">
                                <div class="container-fluid">
                                    <form method="POST" action="{{ route('order.updateprod', $product->id) }}">
                                        @csrf
                
                                        <div class="form-group row">
                                            <label for="product" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>
                
                                            <div class="col-md-6">
                                                <input id="product" type="text" class="form-control" name="product" value="{{ $product->products->name }}" disabled>
                
                                                @error('product')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="qty" class="col-md-4 col-form-label text-md-right">{{ __('Product Quantity') }}</label>
                
                                            <div class="col-md-6">
                                              <input id="qty" type="number" class="form-control @error('qty') is-invalid @enderror" name="qty" value="{{ $product->quantity }}" oninput="add_number()" required>
                
                                              @error('qty')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                          </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Product Price') }}</label>
                
                                            <div class="col-md-6">
                                              <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" oninput="add_number()" required>
                
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
                                                    {{ __('Update Product Order') }}
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