@extends('admin.layouts.layout')

@section('content')

<style media="print">
    .d-print-none{
        display:none;
    }
    .d-print-block{
        display:block!important;
    }

    footer{
        display:none;
    }
</style>

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> Employee Full Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/admin/employees') }}">Employees</a></li>
              <li class="breadcrumb-item active">Full Details</li>
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
            <img src="{{asset('img/logo.png')}}" class="img-fluid w-25" alt="">
            <br><br>
                Employee Details
                <br><br>

            </center>
            </h1>


            <table class="table table-bordered">
                    <tr>
                        <th>Employee Id</th>
                        <td>{{ $employee[0]->emp_id }}</td>
                    </tr>
                    <tr>
                        <th>Barcode</th>
                        <td><img src="{{ asset('phpfile/barcode.php?text=').$employee[0]->emp_id }}" class="img-fluid" alt=""></td>
                    </tr>
                    <tr>
                        <th>Employee Name</th>
                        <td>{{ $employee[0]->emp_name }}</td>
                    </tr>
                    <tr>
                        <th>Employee Email</th>
                        <td>{{ $employee[0]->emp_email }}</td>
                    </tr>
                    <tr>
                        <th>Employee Phone Number</th>
                        <td>{{ $employee[0]->emp_phone }}</td>
                    </tr>
                    <tr>
                        <th>Employee Role</th>
                        <td>{{ $employee[0]->role }}</td>
                    </tr>
                    <tr>
                        <th>Employee Salary</th>
                        <td>Rs. {{ number_format($employee[0]->emp_salary,2) }}/Month</td>
                    </tr>
                    <tr>
                        <th>Employee Account Status</th>
                        <td>
                            @if($employee[0]->acc_status == 1)
                                <b>Active</b>
                            @else
                               <b>Blocked</b>
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <th>Employee Verification Status</th>
                        <td>
                            <?php

                                $emp_verify_doc = $employee[0]->verified_document;
                                $emp_verify_doc = explode('|',$emp_verify_doc);
                            ?>
                            @if(count($emp_verify_doc) > 1)
                                <span class="d-print-none">
                                    <span class="p-0 m-0 d-block text-secondary" style="font-size:10px">Document Type</span>
                                    <b class="p-0 m-0">{{ $emp_verify_doc[0] }}</b>
                                    <a href="{{ url('/admin/employees/delVerRecord?emp_id=').$employee[0]->emp_id }}" class="d-print-none fa fa-times text-sm px-1" title="Delete Verification Record"></a>
                                    <span class="p-0 m-0 d-block text-secondary" style="font-size:10px">Document Number</span>
                                    <b class="p-0 m-0">{{ base64_decode($emp_verify_doc[1]) }}</b>
                                </span>
                                <span class="d-none d-print-block">
                                    <b class="text-success">Verified</b>
                                </span>


                            @else
                                <b class="d-block text-danger">{{ $emp_verify_doc[0] }}
                                <br>
                                <a href="{{url('/admin/employees/verify?emp_id=').$employee[0]->emp_id}}" class="btn btn-sm btn-info d-print-none">Verify Now</a>
                                </b>

                            @endif
                        </td>
                    </tr>
                </table>


                <div class="text-center d-print-none">
                <br><br>
                <button class="btn btn-light " onclick="window.print()"><i class="fa fa-print"></i> Print Now</button> <br><br>

                </div>
                <?php $emp_details = DB::table('employees')->where('emp_id',Session::get('ap_logged_id'))->get()->toarray(); ?>
                <p class="d-none d-print-block py-1">This Record System Generated. No Signature Required <br><b>Record Generated By </b> {{ $emp_details[0]->emp_name }} ({{ $emp_details[0]->role }}) <b> On</b> {{ date('jS M, Y (l) -- h:i:s A') }}</p>

            @else
            <br><br>
            <h3>Employee Not Found</h3>
            @endif

    </section>
    <!-- /.content -->

@endsection
