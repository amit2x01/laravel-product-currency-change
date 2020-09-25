@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Cancelled Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/admin/orders') }}">Orders</a></li>
              <li class="breadcrumb-item active">Cancelled Orders</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

    <div class="table-responsive">
      <table class="table table-bordered table-hover " role="grid" >
        <thead>
            <tr role="row">
              <th scope="col" aria-controls="products" rowspan="1" colspan="1">Id</th>
              <th class="text-center" scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:50px;">Customer Id</th>
              <th  scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:200px">Deliver to</th>
              <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:150px;">Payment Mode</th>
              <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:150px">Order Amount</th>
              <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:150px">Shipping Status</th>
              <th  scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:150px">Order Placed on</th>

            </tr>
        </thead>
        <tbody>

           @foreach($orders as $order)
           <?php  $ord_tracking = DB::table('tracking_services')->where('order_id',$order->ord_id)->get()->toarray(); ?>
                <tr>
                    <td>{{ $order->ord_id }}</td>
                    <td class="text-center bold">{{$order->cust_id}}</td>
                    <td>{{ $order->delivery_address }}</td>
                    <td>{{ $order->payment_mode }}</td>
                    <td>Rs. {{ number_format($order->amount,2) }}</td>
                    <td>

                        <b class="text-danger bold">Cancelled</b>
                    </td>
                    <td>{{ date('jS M, Y',strtotime($order->created_at)) }}</td>
                    

                </tr>
           @endforeach
        </tbody>

      </table>
      </div>

       <div class="pagination ">
			{{ $orders->links() }}
		</div>
    </section>
    <!-- /.content -->

@endsection
