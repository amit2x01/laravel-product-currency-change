@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="">
                <div class="d-flex">
                    <input placeholder="Search Customer ID or Order Id " value="{{ old('search') }}" type="text" style="border-top-right-radius:0;border-bottom-right-radius:0;" class="form-control" name="search">
                    <button type="submit" style="border-top-left-radius:0;border-bottom-left-radius:0;" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
    <br>
    @if(isset($_GET['search']))
    <a href="{{ url('/admin/orders') }}" class="btn btn-danger btn-sm my-2">Clear Search</a>
    @endif
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
              <th  scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:150px">Delivery Date</th>
            </tr>
        </thead>
        <tbody>

           @foreach($orders as $order)
           <?php  $ord_tracking = DB::table('tracking_services')->where('order_id',$order->ord_id)->get()->toarray(); ?>
                <tr>
                    <td>{{ $order->ord_id }} <br><br>
                    @if(count($ord_tracking) > 0)
                        <a href="{{ url('admin/orders/open?oid=').$order->ord_id }}" class="btn btn-sm btn-primary">View</a>
                    @endif
                    </td>
                    <td class="text-center bold">{{$order->cust_id}}</td>
                    <td>{{ $order->delivery_address }}</td>
                    <td>{{ $order->payment_mode }}</td>
                    <td>Rs. {{ number_format($order->amount,2) }}</td>
                    <td>

                        @if(count($ord_tracking) > 0)
                            @if($ord_tracking[0]->delivered != NULL)
                                <span class="text-info bold">Delivered</span></h5>
                            @elseif($ord_tracking[0]->dispatched != NULL)
                                <span class="text-info bold">Dispatched</span></h5>
                            @elseif($ord_tracking[0]->under_processed != NULL)
                                <span class="text-info bold">Under Process</span></h5>
                            @else
                                <span style="color:orangered" class="bold">Order Placed</span></h5>
                            @endif
                        @else
                          <span  class="bold text-danger">Order Cancelled</span></h5>
                        @endif
                    </td>
                    <td>{{ date('jS M, Y',strtotime($order->created_at)) }}</td>
                    <td>

                        @if(count($ord_tracking) > 0)
                            @if($ord_tracking[0]->delivered == NULL)
                             {{ date('jS M, Y',strtotime( $ord_tracking[0]->exp_delivery_date)) }}
                            @else

                             <center>
                                <i class="text-success fa-2x fa fa-check"></i>
                            </center>
                            @endif
                        @else
                            <center>
                                <i class="text-danger fa-2x fa fa-times"></i>
                            </center>
                        @endif
                    </td>

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
