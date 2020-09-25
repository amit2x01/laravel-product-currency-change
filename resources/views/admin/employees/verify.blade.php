@extends('admin.layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Verify Employee</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/admin/employees') }}">Employees</a></li>
              <li class="breadcrumb-item active">Verify</li>
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
              Employee Verifycation
              <br><br>
            </center>
            </h1>
        <form action="{{ url('/admin/employees/verify') }}" method="post">
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
                    <td style="min-width:270px;">Verification Document Type</td>
                    <td style="min-width:350px;">
                      <select name="doc_type" class="form-control" require>
                        <option value="">-- Select --</option>
                        <option value="Aadhar Card">Aadhar Card</option>
                        <option value="PAN Card">PAN Card</option>
                        <option value="Ration Card">Election/Voter/EPIC Card</option>
                      </select>
                      <span class="text-sm text-danger py-2">
                         @if($errors->has('doc_type'))
                            <span class="text-danger text-16 bold">{{ $errors->first('doc_type') }}</span>
                        @endif
                      </span>
                    </td>
                  </tr>
                  <tr>
                    <td style="min-width:270px;">Verification Document Number</td>
                    <td style="min-width:350px;"><input type="text" name="doc_id"  class="form-control" require>
                    <span class="text-sm text-danger py-2">
                         @if($errors->has('doc_id'))
                            <span class="text-danger text-16 bold">{{ $errors->first('doc_id') }}</span>
                        @endif
                    </span>
                    
                    </td>
                    
                  </tr>
                </table>
                <br>
                <center>
                  <button class="btn btn-sm btn-info px-3">Verify & Save Verification Record</button>
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
