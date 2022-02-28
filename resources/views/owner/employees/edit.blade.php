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
                <h1 class="m-0">Edit Employee Details</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/owner">Home</a></li>
                <li class="breadcrumb-item active">Employee Details</li>
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
                            {{ __('Edit Store Details') }}
                        </div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <section class="content">
                                <div class="container-fluid">
                                    <form method="POST" action="{{ route('employees.update', $employee->id) }}">
                                        @csrf
                                        <input type="hidden" name="_method" value="PUT">   {{-- to support POST method on this form since the route support put method --}}
                
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Employee Name') }}</label>
                
                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control" @error('location') is-invalid @enderror" name="name" value="{{ $employee->name }}" disabled>
                
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label for="phonenumber" class="col-md-4 col-form-label text-md-right">{{ __('Employee Phone-Number') }}</label>
                
                                            <div class="col-md-6">
                                              <input id="phonenumber" type="tel" pattern="[0-9]{4}-[0-9]{6}" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" value="{{ $employee->phonenumber }}" disabled>
                
                                              @error('phonenumber')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                              @enderror
                                          </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="store" class="col-md-4 col-form-label text-md-right">{{ __('Store') }}</label>
                
                                            <div class="col-md-6">
                                                @if ($store)
                                                    <select name="store" id="store" class="form-control">
                                                        @foreach ($store as $stor)
                                                            <option value="{{ $stor->id }}">{{ $stor->name }} | {{ $stor->location }}</option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                                @error('store')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                
                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Update Employee Details') }}
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
@endsection