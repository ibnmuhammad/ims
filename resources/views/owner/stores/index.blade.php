@extends('layouts.appowner')

@section('content')
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Stores</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/owner">Home</a></li>
                <li class="breadcrumb-item active">Stores</li>
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
                            <h3 class="card-title">Stores</h3>
                            <div class="btn btn-default float-right">
                                <a href="{{ route('stores.create') }}">Add New Store</a>
                            </div>
                        </div>
                        {{-- card header end  --}}
                        {{-- card body start  --}}
                        <div class="card-body">
                            {{-- <div class="table-responsive"> --}}
                                <table class="table table-bordered table-hover" id="storeTable" cellspacing="0">
                                    <thead>
                                    <tr>
                                      <th>Store ID</th>
                                      <th>Store Name</th>
                                      <th>Store Location</th>
                                      <th>{{ __('Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($stores)>0)
                          
                                      @foreach ($stores as $store)
                                      <tr>
                                        <td>{{ $store->id }}</td>
                                        <td>{{ $store->name }}</td>
                                        <td>{{ $store->location }}</td>
                                        <td>
                                          <a class="btn btn-info btn-sm" href="{{ route('stores.edit', $store->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Change details
                                        </a>
                                        <a class="btn btn-danger btn-sm" onclick="return myFunction();">
                                            <form action="{{ route('stores.destroy', $store->id) }}" method="POST" class="form-inline">
                                                @csrf
                                                @method("DELETE")
                                                <i class="fas fa-trash">
                                                </i>
                                                <input type="submit" class="btn btn-danger btn-sm" value="Delete Store">
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