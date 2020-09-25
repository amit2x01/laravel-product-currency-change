@extends('admin.layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                @if(isset($_GET['type']))
                    @if($_GET['type'] == 'verified')
                        All Verified Employees
                    @elseif($_GET['type'] == 'notverified')
                        All Not Verifed Employees
                    @elseif($_GET['type'] == 'blocked')
                        All Blocked Employees
                    @else
                        All Employees
                    @endif
                @else
                    All Employees
                @endif
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Employees</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <a href="{{url('/admin/employees/add')}}" class="btn btn-sm bg-gradient-info">+ Add New Employee</a>
    <div class="row">
        <div class="col-md-3">
            @if(isset($_GET['search']))
             <a href="{{ url('/admin/employees') }}" class="btn btn-danger btn-sm my-2">Clear Search</a>
            @endif
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="">
                <div class="d-flex">
                    <input placeholder="Search Empolyee ID " value="{{ old('search') }}" type="text" style="border-top-right-radius:0;border-bottom-right-radius:0;" class="form-control" name="search">
                    <button type="submit" style="border-top-left-radius:0;border-bottom-left-radius:0;" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered table-hover " role="grid" >
        <thead>
            <tr role="row">
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:130px;">Empolyee Id</th>
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:200px;">Empolyee Name</th>
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:180px;">Empolyee Email</th>
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:180px;">Empolyee Phone</th>
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:100px;">Password</th>
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:180px;">Empolyee Type</th>
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:180px;">Empolyee Salary</th>
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:180px;">Employee Verification</th>
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:180px;">Account Status</th>
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:180px;">Date of Join</th>
            </tr>
        </thead>
        <tbody>

           @foreach($employees as $employee)
                <tr>
                    <td>{{ $employee->emp_id }}

                    <a href="{{ url('/admin/employees/update?emp_id=').$employee->emp_id }}" class="text-danger fa fa-pen p-1 text-sm" title="Edit Employee Details"></a>
                    <a href="{{ url('/admin/employees/view?emp_id=').$employee->emp_id }}" class="text-success fa fa-eye p-1 text-sm" title="View Employee Details"></a>

                    </td>
                    <td> <b>{{ $employee->emp_name }}</b>

                    @if($employee->emp_id != Session::get('ap_logged_id'))
                    <br><br>
                        @if($employee->acc_status == "1")
                        <a href="{{ url('/admin/employees/block?emp_id=').$employee->emp_id }}" class="btn btn-sm btn-flat btn-warning" style="padding:2px 10px;border-bottom:2px solid orangered!important;">Block Now</a>
                        @else
                        <a href="{{ url('/admin/employees/unblock?emp_id=').$employee->emp_id }}" class="btn btn-sm btn-flat btn-info" style="padding:2px 10px;border-bottom:2px solid #1049a0!important;">Unblock Now</a>
                        @endif

                        <a href="{{ url('/admin/employees/custdelete?emp_id=').$employee->emp_id }}" class="btn btn-sm btn-flat btn-outline-danger" style="padding:6px 10px;border-width:2px;"><i class="fa fa-trash-alt text-12"></i></a>
                    @else
                       <div class="float-right badge bg-primary my-1">
                            You
                       </div>
                    @endif
                    &nbsp&nbsp

                    </td>
                    <td>{{ $employee->emp_email }}</td>
                    <td>+91 {{ $employee->emp_phone }}</td>
                    <td>
                        <a href="{{ url('/admin/employees/update/password?emp_id=').$employee->emp_id }}" class="btn btn-sm btn-primary px-4">Change Password</a>
                    </td>
                    <td>{{ $employee->role }}</td>
                    <td>Rs. {{ number_format($employee->emp_salary,2) }}/M</td>
                    <td class="py-0">
                        <?php

                            $emp_verify_doc = $employee->verified_document;
                            $emp_verify_doc = explode('|',$emp_verify_doc);
                        ?>
                        @if(count($emp_verify_doc) > 1)
                            <span class="p-0 m-0 d-block text-secondary" style="font-size:10px">Document Type</span>
                            <b class="p-0 m-0">{{ $emp_verify_doc[0] }}</b>
                            <a href="{{ url('/admin/employees/delVerRecord?emp_id=').$employee->emp_id }}" class="fa fa-times text-sm px-1" title="Delete Verification Record"></a>
                            <span class="p-0 m-0 d-block text-secondary" style="font-size:10px">Document Number</span>
                            <b class="p-0 m-0">{{ base64_decode($emp_verify_doc[1]) }}</b>
                        @else
                            <b class="text-center d-block text-danger">{{ $emp_verify_doc[0] }}
                            <br>
                            <a href="{{url('/admin/employees/verify?emp_id=').$employee->emp_id}}" class="btn btn-sm btn-info">Verify Now</a>
                            </b>

                        @endif


                    </td>
                    <td class="text-center">
                            @if($employee->acc_status == "1")
                                <span class="text-success bold">Active</span>
                            @else
                                <span class="text-danger bold">Blocked</span>
                            @endif
                    </td>
                    <td>{{ date('jS M, Y', strtotime($employee->created_at)) }}</td>
                </tr>
           @endforeach
        </tbody>

      </table>
      </div>

    <div class="pagination ">
        {{ $employees->links() }}
    </div>
    </section>
    <!-- /.content -->

@endsection
