@extends('admin.layouts.layout')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Customers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Cutomers</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-3">
            @if(isset($_GET['search']))
             <a href="{{ url('/admin/customers') }}" class="btn btn-danger btn-sm my-2">Clear Search</a>
            @endif
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="">
                <div class="d-flex">
                    <input placeholder="Search Customer ID " value="{{ old('search') }}" type="text" style="border-top-right-radius:0;border-bottom-right-radius:0;" class="form-control" name="search">
                    <button type="submit" style="border-top-left-radius:0;border-bottom-left-radius:0;" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered table-hover " role="grid" >
        <thead>
            <tr role="row">
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:130px;">Customer Id</th>
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:200px;">Customer Name</th>
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:180px;">Customer Email</th>
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:180px;">Customer Phone</th>
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:180px;">Customer Gender</th>
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:180px;">Age</th>
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:180px;">Account Status</th>
            <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:180px;">Date of Join</th>
            </tr>
        </thead>
        <tbody>

           @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->cust_id }}</td>
                    <td> <b>{{ $customer->cust_name }}</b>
                    <br><br>
                    @if($customer->acc_status == "1")
                    <a href="{{ url('/admin/customers/block?cid=').$customer->cust_id }}" class="btn btn-sm btn-flat btn-warning" style="padding:2px 10px;border-bottom:2px solid orangered!important;">Block Now</a>
                    @else
                    <a href="{{ url('/admin/customers/unblock?cid=').$customer->cust_id }}" class="btn btn-sm btn-flat btn-info" style="padding:2px 10px;border-bottom:2px solid #1049a0!important;">Unblock Now</a>
                    @endif

                    <a href="{{ url('/admin/customers/custdelete?cid=').$customer->cust_id }}" class="btn btn-sm btn-flat btn-outline-danger" style="padding:6px 10px;border-width:2px;"><i class="fa fa-trash-alt text-12"></i></a>
                    </td>
                    <td>{{ $customer->cust_email }}</td>
                    <td>{{ $customer->cust_phone }}</td>
                    <td class="text-center">{{ $customer->cust_gender }}</td>
                    <td class="text-center"><?php
                            $dob = new DateTime($customer->cust_dob);
                            $today = new DateTime(date('m.d.y'));
                            $age =  $today->diff($dob);
                            if($age->y > 0):
                                echo $age->y." Years";
                            else:
                                echo "Unknown";
                            endif;
                        ?></td>
                    <td class="text-center">
                            @if($customer->acc_status == "1")
                                <span class="text-success bold">Active</span>
                            @else
                                <span class="text-danger bold">Blocked</span>
                            @endif
                    </td>
                    <td>{{ date('jS M, Y', strtotime($customer->created_at)) }}</td>
                </tr>
           @endforeach
        </tbody>

      </table>
      </div>

    <div class="pagination ">
        {{ $customers->links() }}
    </div>
    </section>
    <!-- /.content -->

@endsection
