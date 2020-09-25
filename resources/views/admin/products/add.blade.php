@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add New Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/admin/products') }}">Products</a></li>
              <li class="breadcrumb-item active">Add New</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content px-5">
        <form action="{{ url('/admin/products/add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Product Image</label>
                <span class="text-sm text-danger bold">*
                    @if($errors->has('pimage'))
                       {{ $errors->first('pimage') }}
                    @endif
                </span>
                <div class="custom-file">
                    <input type="file"name="pimage" id="customFile" accept="image/png, image/jpeg, image/jpg, image/gif">

                </div>
                <br><br>
                <div class="alert alert-info px-5">
                    <ul>
                        <li>Image size less then 5mb</li>
                        <li>Image extensions must be JPG/JPEG/PNG/GIF</li>
                    </ul>
                </div>
            </div>

            <div class="form-group">
                <label>Product Title</label>
                <span class="text-sm text-danger bold">*
                    @if($errors->has('ptitle'))
                       {{ $errors->first('ptitle') }}
                    @endif
                </span>
                <input type="text" class="form-control" name="ptitle">
            </div>

            <div class="form-group">
                <label>Product Short Description</label>
                <textarea class="advTextarea-no_table form-control" name="pshortDesc" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label>Product Long Description</label>
                <textarea class="advTextarea form-control" rows="5" name="pDesc"></textarea>
            </div>
            <div class="form-group" >
                  <label>Select Categorie</label>
                  <select class="form-control select2bs4" style="width: 100%;" name="pcate">
                    <option value="" selected="selected">- NA -</option>
                    <?php $categories = DB::table('categories')->get()->toarray(); ?>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->cate_id }}">{{$categorie->cate_name}}</option>
                    @endforeach
                  </select>
                </div>



            <div class="form-group">

                <label>Product Price <sup class="fa fa-rupee-sign"></sup></label>
                <span class="text-sm text-danger bold"> *
                    @if($errors->has('price'))
                       {{ $errors->first('price') }}
                    @endif
                </span>
                <input type="number" name="price" class="form-control">
            </div>

            <div class="form-group">

                <label>Product M.R.P <sup class="fa fa-rupee-sign"></sup></label>
                <span class="text-sm text-danger bold"> *
                    @if($errors->has('mrp'))
                       {{ $errors->first('mrp') }}
                    @endif
                </span>
                <input type="number" name="mrp" class="form-control">
            </div>

            <div class="form-group">
                <label>Product Brand</label>
                <span class="text-sm text-danger bold"> *
                    @if($errors->has('pbrand'))
                       {{ $errors->first('pbrand') }}
                    @endif
                </span>
                <input type="text" name="pbrand" class="form-control">
            </div>

            <div class="form-group">
                <label>Product Car Model Number</label>
                <span class="text-sm text-danger bold"> *
                    @if($errors->has('pmodel'))
                       {{ $errors->first('pmodel') }}
                    @endif
                </span>
                <input type="text" name="pmodel" class="form-control">
            </div>
            <br><br>
            <div class="text-right">
                  <button type="submit" class="btn px-3 bg-gradient-info">Save Product</button>
            </div>
        </form>
    </section>
    <!-- /.content -->


@endsection
