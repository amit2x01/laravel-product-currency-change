@extends('admin.layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Update Employee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/admin/employees') }}">Employees</a></li>
              <li class="breadcrumb-item active">Update</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

                <?php

            $emp_id = (isset($_GET['emp_id'])) ? $_GET['emp_id'] : 0;

            $employee = DB::table('employees')->where('emp_id',$emp_id)->get()->toarray();

            ?>

            @if(count($employee) > 0)
            <h1>
            <center>
                Update Employee Details
                <br><br>
            </center>
            </h1>
            <form action="{{ url('/admin/employees/update') }}" method="post">
        @csrf
           <div class="container px-5">
              <label>Employee Id <span class="text-sm text-danger bold">* Do not Change</span></label>
              <input type="text" class="form-control disabled" readonly name="emp_id" value="{{ $employee[0]->emp_id }}">
              <span class="text-sm text-danger py-2">
                @if($errors->has('emp_id'))
                    <span class="text-danger text-16 bold">{{ $errors->first('emp_id') }}</span>
                @endif
              </span><br>
              <label>Employee Name</label>
              <input type="text" class="form-control" name="emp_name" value="{{ $employee[0]->emp_name }}">
              <span class="text-sm text-danger py-2">
                @if($errors->has('emp_name'))
                    <span class="text-danger text-16 bold">{{ $errors->first('emp_name') }}</span>
                @endif
              </span><br>
              <label class="mt-2">Empolyee Email</label>
              <input type="text" class="form-control" name="emp_email" value="{{ $employee[0]->emp_email }}">
              <span class="text-sm text-danger py-2">
                @if($errors->has('emp_email'))
                    <span class="text-danger text-16 bold">{{ $errors->first('emp_email') }}</span>
                @endif
              </span><br>
              <label class="mt-2">Empolyee Phone</label>
              <input type="text" class="form-control" name="emp_phone" value="{{ $employee[0]->emp_phone }}">
              <span class="text-sm text-danger py-2">
                @if($errors->has('emp_phone'))
                    <span class="text-danger text-16 bold">{{ $errors->first('emp_phone') }}</span>
                @endif
              </span><br>
              <label class="mt-2">Empolyee Type/Role</label>
              <select class="form-control" name="emp_type">
                <option value="">-- select --</option>
                <option value="{{ $employee[0]->role }}" hidden selected>{{ $employee[0]->role }}</option>

                <option value="Admin">Admin</option>
                <option value="Staff">Staff</option>

              </select>
              <span class="text-sm text-danger py-2">
                @if($errors->has('emp_type'))
                    <span class="text-danger text-16 bold">{{ $errors->first('emp_type') }}</span>
                @endif
              </span><br>
              <label class="mt-2">Empolyee Salary <span class="text-sm bold">(Per Month)</span></label>
              <input type="text" class="form-control" name="emp_sal" value="{{ $employee[0]->emp_salary }}">
              <span class="text-sm text-danger py-2">
                @if($errors->has('emp_sal'))
                    <span class="text-danger text-16 bold">{{ $errors->first('emp_sal') }}</span>
                @endif
              </span>

              <br><br>
               <div class="text-right">
                <button class="btn  bg-gradient-primary">Update Record</button>
               </div>
            </div>
          <form>
            @else
            <br><br>
            <h3>Employee Not Found</h3>
            @endif

    </section>
    <!-- /.content -->

@endsection
