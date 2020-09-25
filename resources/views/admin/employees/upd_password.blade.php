@extends('admin.layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Update Employee Account Password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/admin/employees') }}">Employees</a></li>

              <li class="breadcrumb-item active">Update Password</li>
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
              Employee Password Update
              <br><br>
            </center>
            </h1>
        <form action="{{ url('/admin/employees/update/password') }}" method="post">
           <div class="container px-5">
              <div class="table-responsive">
                <table class="table table-borderless">
                  <tr>
                    <td style="min-width:270px;">Employee id </td>
                    <td style="min-width:350px;"><input type="text" value="{{ $employee[0]->emp_id }}" class="form-control disabled" disabled></td>
                    <input type="hidden" name="emp_id" value="{{ $employee[0]->emp_id }}">
                    @csrf
                  </tr>
                  <tr>
                    <td style="min-width:270px;">Employee Name </td>
                    <td style="min-width:350px;"><input type="text" value="{{ $employee[0]->emp_name }}" class="form-control disabled" disabled></td>

                  </tr>
                  <tr>
                    <td style="min-width:270px;">New Password</td>
                    <td style="min-width:350px;">
                        <input type="password" class="form-control" name="emp_pass">
                        <span class="text-sm text-danger py-2">
                            @if($errors->has('emp_pass'))
                                <span class="text-danger text-16 bold">{{ $errors->first('emp_pass') }}</span>
                            @endif
                        </span><br>
                    </td>
                  </tr>

                </table>
                <br>
                <center>
                  <button class="btn btn-sm btn-info px-3">Update Password</button>
                </center>
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
