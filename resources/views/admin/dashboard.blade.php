@extends('admin.layouts.layout')

@section('content')

  <?php


    $orders = DB::table('orders')->get();
    $customers = DB::table('customers')->where('acc_status',1)->get();
    $products = DB::table('products')->get();

  ?>


<?php

$total_orders = count($orders);
$pending_orders = 0;
$shipped_orders = 0;
$processing_orders = 0;
$delivered_orders = 0;
$cancelled_orders = 0;

foreach($orders as $order){

  $ord_tracking = DB::table('tracking_services')->where('order_id',$order->ord_id)->get()->toarray();

  if(count($ord_tracking) > 0){
    if($ord_tracking[0]->under_processed == NULL){
      $pending_orders++;
    }else if($ord_tracking[0]->dispatched == NULL){
      $processing_orders++;
    }else if($ord_tracking[0]->delivered == NULL){
      $shipped_orders++;
    }else{
      $delivered_orders++;
    }

  }else{
    $cancelled_orders ++;
  }



}

?>

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admin Panel</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>

            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <br>
        <img src="{{asset('img/logo.png')}}" class="img-fluid w-25" alt="">
        <br><br>
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{count($orders)}}</h3>

                <p>Total Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ url('admin/orders') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{count($customers)}}</h3>

                <p>Total Active Customers</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ url('admin/customers') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{count($products)}}</h3>

                <p>Total Products</p>
              </div>
              <div class="icon">
                <i class="fa fa-book text-10"></i>
              </div>
              <a href="{{ url('admin/products') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <br><br>

        <!-- DONUT CHART -->
        <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Orders Report Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" ></button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <div class="card-footer">
              <b>Total Orders</b><span class="text-danger px-2"><?= $total_orders ?></span>
              <b>Pending Orders</b><span class="text-danger px-2"><?= $pending_orders ?></span>
              <b>Processing Orders</b><span class="text-danger px-2"><?= $processing_orders ?></span>
              <b>Shipped Orders</b><span class="text-danger px-2"><?= $shipped_orders ?></span>
              <b>Delivered Orders</b><span class="text-danger px-2"><?= $delivered_orders ?></span>
              <b>Cancelled Orders</b><span class="text-danger px-2"><?= $cancelled_orders ?></span>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->



<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<script>
  //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [

          'Pending Orders',
          'Processing Orders',
          'Shipped Orders',
          'Delivered Orders',
          'Cancelled Orders',
      ],
      datasets: [
        {
          data: [<?= $pending_orders ?>,<?= $processing_orders ?>,<?= $shipped_orders ?>,<?= $delivered_orders ?>,<?= $cancelled_orders ?>],
          backgroundColor : ['#f56954', '#f39c12', '#00c0ef', '#3c8dbc','#DC3545'],
        }
      ]
    }

    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

</script>

@endsection
