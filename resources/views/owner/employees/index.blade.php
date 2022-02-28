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
                <h1 class="m-0">Employees</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/owner">Home</a></li>
                <li class="breadcrumb-item active">Employees</li>
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
                            <h3 class="card-title">Employees</h3>
                            <div class="btn btn-default float-right">
                                <a href="{{ route('employees.create') }}">Add New Employee</a>
                            </div>
                        </div>
                        {{-- card header end  --}}
                        {{-- card body start  --}}
                        <div class="card-body">
                            {{-- <div class="table-responsive"> --}}
                                <table class="table table-bordered table-hover" id="storeTable" cellspacing="0">
                                    <thead>
                                    <tr>
                                      <th>Employee Name</th>
                                      <th>Phone Number</th>
                                      <th>Gender</th>
                                      <th>Store Name</th>
                                      <th>Store Location</th>
                                      <th>{{ __('Action') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($employees)>0)
                          
                                      @foreach ($employees as $employee)
                                      <tr>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->phonenumber }}</td>
                                        <td>{{ $employee->gender }}</td>
                                        <td>{{ $employee->store->name }}</td>
                                        <td>{{ $employee->store->location }}</td>
                                        <td>
                                          <a class="btn btn-info btn-sm" href="{{ route('employees.edit', $employee->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Change details
                                        </a>
                                        <a class="btn btn-danger btn-sm" onclick="return myFunction();">
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="form-inline">
                                                @csrf
                                                @method("DELETE")
                                                <i class="fas fa-trash">
                                                </i>
                                                <input type="submit" class="btn btn-danger btn-sm" value="Delete Employee">
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