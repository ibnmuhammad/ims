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
                                <table class="table table-bordered table-hover" cellspacing="0">
                                    <thead>
                                    <tr>
                                      <th>Sale ID</th>
                                      <th>Date</th>
                                      <th>Client Name</th>
                                      <th>Client Phone-Number</th>
                                      <th>Products Purchased</th>
                                      <th>Total Amount</th>
                                      <th>Status</th>
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
                                    </tr>
                                    </thead>
                                    <tbody>
                                      @foreach ($sale->soldproduct as $sold)
                                        <tr>
                                            <td>{{ $sold->products->name }}</td>
                                            <td>{{ $sold->quantity }}</td>
                                            <td>{{ number_format( $sold->price ) }}</td>
                                            <td>{{ number_format($sold->total_amount) }}</td>
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
@endsection