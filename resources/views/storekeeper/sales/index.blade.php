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
                <h1 class="m-0">Sales</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/storekeeper">Home</a></li>
                <li class="breadcrumb-item active">Sales</li>
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
                            <h3 class="card-title">Sales</h3>
                            <div class="btn btn-default float-right">
                                <a href="{{ route('sales.create') }}">New Sale Order</a>
                            </div>
                        </div>
                        {{-- card header end  --}}
                        {{-- card body start  --}}
                        <div class="card-body">
                            {{-- <div class="table-responsive"> --}}
                                <table class="table table-bordered table-hover" id="workerTable" cellspacing="0">
                                    <thead>
                                    <tr>
                                      <th>Order ID</th>
                                      <th>Client Name</th>
                                      <th>Client Phone-Number</th>
                                      <th>Products Purchased</th>
                                      <th>Total Amount</th>
                                      <th>Status</th>
                                      <th>{{ __('Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($sales)>0)
                                      @foreach ($sales as $sale)
                                      <tr>
                                        <td>{{ $sale->id }}</td>
                                        <td>{{ $sale->client }}</td>
                                        <td>{{ $sale->phonenumber }}</td>
                                        <td>{{ $sale->soldproduct->sum('quantity') }}</td>
                                        <td>TZS {{ number_format($sale->soldproduct->sum('total_amount')) }}</td>
                                        <td>
                                            @if (!$sale->finalized_at)
                                                <span class="text-danger">On Hold</span>
                                            @else
                                                <span class="text-success">Finalized</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$sale->finalized_at)
                                                <a class="btn btn-success btn-sm" href="{{ route('sales.edit', $sale->id) }}" title="Edit Sale">
                                                    <i class="fas fa-pencil-alt">
                                                    </i>
                                                </a>
                                            @else
                                                <a class="btn btn-info btn-sm" href="{{ route('sale.showsale', $sale->id) }}" title="Show Sale">
                                                    <i class="fas fa-eye">
                                                    </i>
                                                </a>
                                            @endif
                                            <a class="btn btn-danger btn-sm" onclick="return myFunction();">
                                                <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" class="form-inline">
                                                    @csrf
                                                    @method("DELETE")
                                                    <i class="fas fa-trash">
                                                    </i>
                                                    <input type="submit" class="btn btn-danger btn-sm" value="Delete Sale">
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