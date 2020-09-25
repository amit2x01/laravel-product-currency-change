@extends('admin.layouts.layout')

@section('content')
<?php $payment_table_loop_id = 0; ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Payments</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Payments</li>
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
             <a href="{{ url('/admin/payments') }}" class="btn btn-danger btn-sm my-2">Clear Search</a>
            @endif
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="">
                <div class="d-flex">
                    <input placeholder="Search Customer ID or Order Id or Transaction Id" value="{{ old('search') }}" type="text" style="border-top-right-radius:0;border-bottom-right-radius:0;" class="form-control" name="search">
                    <button type="submit" style="border-top-left-radius:0;border-bottom-left-radius:0;" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered table-hover " role="grid" >
        <thead>
            <tr role="row">
            <th scope="col" aria-controls="products" rowspan="1" colspan="1">#</th>
              <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:100px"></th>
              <th  scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:130px">Transaction Id</th>
              <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:300px;max-width:300px">Transaction Ref Id</th>
              <th  scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:150px">Amount</th>
              <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:150px">Date of Payment </th>
              <th  scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:190px">Payment Status</th>
              <th  scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:150px">Customer Id</th>
              <th  scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:170px">Customer Name</th>
              <th  scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:150px">Order Id</th>
              <th  scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:150px">Payment Made by</th>


            </tr>
        </thead>
        <tbody>

           @foreach($payments as $payment)
                <tr>
                    <td>{{ ++$payment_table_loop_id }}</td>
                    <td>
                        @if($payment->status == "PAID" || $payment->status == "Refund Requested")
                            <a href="{{ url('admin/payments/msrefunded?txn_id=').$payment->transaction_id }}" class="btn btn-sm btn-danger p-1" style="font-size:10px!important;">Status Make Refunded</a>
                        @else
                        <a href="#" class="btn btn-sm btn-light p-1 disabled" style="font-size:10px!important;">Status Make Refunded</a>
                        @endif
                    </td>
                    
                    <?php $cust_details = DB::table('customers')->where('cust_id',$payment->cust_id)->get()->toarray(); ?>

                    <td>{{ $payment->transaction_id }}</td>
                    <td>{{ $payment->txn_ref_no }}</td>
                    <td class="text-center">Rs. {{ number_format($payment->amount,2) }}</td>
                    <td>{{ date('jS M, Y',strtotime($payment->created_at)) }}</td>
                    <td class="text-center bold">{{ $payment->status }}</td>
                    <td class="text-center">{{ $payment->cust_id }}</td>
                    <td class="text-center">{{ $cust_details[0]->cust_name }}</td>
                    <td class="text-center">{{ $payment->order_id }}</td>
                    <td>{{ $payment->payment_made_by }}</td>
                </tr>
           @endforeach
        </tbody>

      </table>
      </div>

    <div class="pagination ">
        {{ $payments->links() }}
    </div>
    </section>
    <!-- /.content -->

@endsection
