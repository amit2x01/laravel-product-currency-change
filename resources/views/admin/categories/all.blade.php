@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">All Categories</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <br><br>
    <a href="{{ url('/admin/categories/add') }}" class="btn btn-primary">Add New Category</a> <br><br>
    <div class="table-responsive-sm">
      <table class="table table-bordered table-hover " role="grid" >
        <thead>
            <tr role="row">
              <th scope="col" aria-controls="products" rowspan="1" colspan="1">Id</th>
              <th  scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:100px">Image</th>
              <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:300px;max-width:300px">Categorie Name</th>
              <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:50px">Products</th>
              <th scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:150px">Created On</th>
              <th  scope="col" aria-controls="products" rowspan="1" colspan="1" style="min-width:150px">Action</th>
            </tr>
        </thead>
        <tbody>

           @foreach($categories as $Category)
                <tr>
                    <td>{{ $Category->cate_id }}</td>
                    <td><img src="{{ asset($Category->cate_img) }}" class="img-fluid" style="width:50px" alt=""></td>
                    <td>{{ $Category->cate_name }}</td>
                    <td class="text-center">
                        <?php $cate_products_count = DB::table('products')->where('category_id', $Category->cate_id)->get()->toarray(); ?>

                        <span>{{ count($cate_products_count) }}</span>
                    </td>
                    <td>{{ date('jS M, Y',strtotime($Category->created_at)) }}</td>
                    <td>
                        <a href="{{ url('/admin/categories/modify?cate_id=').$Category->cate_id }}" class="btn btn-warning btn-sm text-sm"><i class="fa fa-edit"></i></a>
                        <a href="{{ url('/admin/categories/delete?cate_id=').$Category->cate_id }}" class="btn btn-danger btn-sm text-sm"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
           @endforeach
        </tbody>

      </table>
      </div>

       <div class="pagination ">
			{{ $categories->links() }}
		</div>
    </section>
    <!-- /.content -->

@endsection
