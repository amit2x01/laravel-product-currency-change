@extends('admin.layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Employee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/admin/employees') }}">Employees</a></li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

          <h1>
            <center>
              Add New Employee
              <br><br>
            </center>
            </h1>
        <form action="{{ url('/admin/employees/add') }}" method="post">
        @csrf
           <div class="container px-5">
              <label>Employee Name</label>
              <input type="text" class="form-control" name="emp_name" value="{{ old('emp_name') }}">
              <span class="text-sm text-danger py-2">
                @if($errors->has('emp_name'))
                    <span class="text-danger text-16 bold">{{ $errors->first('emp_name') }}</span>
                @endif
              </span><br>
              <label class="mt-2">Empolyee Email</label>
              <input type="text" class="form-control" name="emp_email" value="{{ old('emp_email') }}">
              <span class="text-sm text-danger py-2">
                @if($errors->has('emp_email'))
                    <span class="text-danger text-16 bold">{{ $errors->first('emp_email') }}</span>
                @endif
              </span><br>
              <label class="mt-2">Empolyee Phone</label>
              <input type="text" class="form-control" name="emp_phone" value="{{ old('emp_phone') }}">
              <span class="text-sm text-danger py-2">
                @if($errors->has('emp_phone'))
                    <span class="text-danger text-16 bold">{{ $errors->first('emp_phone') }}</span>
                @endif
              </span><br>
              <label class="mt-2">Empolyee Type/Role</label>
              <select class="form-control" name="emp_type">
                <option value="">-- select --</option>
                <option value="Admin">Admin</option>
                <option value="Staff">Staff</option>

              </select>
              <span class="text-sm text-danger py-2">
                @if($errors->has('emp_type'))
                    <span class="text-danger text-16 bold">{{ $errors->first('emp_type') }}</span>
                @endif
              </span><br>
              <label class="mt-2">Empolyee Salary <span class="text-sm bold">(Per Month)</span></label>
              <input type="text" class="form-control" name="emp_sal" value="{{ old('emp_sal') }}">
              <span class="text-sm text-danger py-2">
                @if($errors->has('emp_sal'))
                    <span class="text-danger text-16 bold">{{ $errors->first('emp_sal') }}</span>
                @endif
              </span> <br>
              <label class="mt-2">Password</label>
              <input type="text" class="form-control" name="emp_pass">
              <span class="text-sm text-danger py-2">
                @if($errors->has('emp_pass'))
                    <span class="text-danger text-16 bold">{{ $errors->first('emp_pass') }}</span>
                @endif
              </span>
              <br><br>
               <div class="text-right">
                <button class="btn  bg-gradient-primary">Add Record</button>
               </div>
            </div>
          <form>

    </section>
    <!-- /.content -->

@endsection
