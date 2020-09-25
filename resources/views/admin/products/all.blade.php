@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <br><br>
    <a href="{{ url('/admin/products/add') }}" class="btn btn-primary">Add New Product</a> <br><br>
    <div class="table-responsive-sm">
      <table class="table table-bordered table-hover " role="grid" >
        <thead>
            <tr role="row">
              <th scope="col" aria-controls="products" rowspan="1" colspan="1">Id</th>
              <th  scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:100px">Image</th>
              <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:300px;max-width:300px">Product Name</th>
              <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:150px">Date</th>
              <th  scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:150px">Action</th>
            </tr>
        </thead>
        <tbody>

           @foreach($products as $product)
                <tr>
                    <td>{{ $product->pid }}</td>
                    <td><img src="{{ asset($product->pimage) }}" class="img-fluid" style="width:50px" alt=""></td>
                    <td>{{ $product->ptitle }}

                        <br>
                        <p class="text-danger"><b class="text-primary">Brand:&nbsp</b> {{$product->brand}} &nbsp&nbsp <b class="text-primary">Model:&nbsp</b> {{$product->model}} &nbsp&nbsp  <b class="text-primary">Price: &nbsp</b>Rs. {{number_format($product->price,2)}}</p>
                    </td>
                    <td>{{ date('jS M, Y',strtotime($product->created_at)) }}</td>
                    <td>
                        <a href="{{ url('/products/open?pid=').$product->pid }}" target="_BLANK" class="btn btn-light btn-sm text-sm"><i class="fa fa-eye"></i></a>
                        <a href="{{ url('/admin/products/modify?pid=').$product->pid }}" class="btn btn-warning btn-sm text-sm"><i class="fa fa-edit"></i></a>
                        <a href="{{ url('/admin/products/delete?pid=').$product->pid }}" class="btn btn-danger btn-sm text-sm"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
           @endforeach
        </tbody>

      </table>
      </div>

       <div class="pagination ">
			{{ $products->links() }}
		</div>
    </section>
    <!-- /.content -->

@endsection
