@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Update Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/admin/products') }}">Products</a></li>
              <li class="breadcrumb-item active">Update</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content px-5">
        <?php
            $req_pid = (isset($_GET['pid'])) ? $_GET['pid'] : 0;
            $product = DB::table('products')->where('pid',$req_pid)->get()->toarray();
        ?>
        @if(count($product) > 0)
        <?php $product = $product[0]; ?>
        <form action="{{ url('/admin/products/modify/image') }}"  method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $product->pid }}" name="pid">
            <div class="row">
                <div class="col-md-6">
                <img src="{{ asset($product->pimage) }}" class="img-fluid w-100" style="max-height:400px" alt="">
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Product Image</label>
                        <span class="text-sm text-danger bold">*
                            @if($errors->has('pimage'))
                            {{ $errors->first('pimage') }}
                            @endif
                        </span>
                        <div class="custom-file">
                            <input type="file"name="pimage" value="" id="customFile" accept="image/png, image/jpeg, image/jpg, image/gif">

                        </div>
                        <br><br>
                        <div class="alert alert-info px-5">
                            <ul>
                                <li>Image size less then 5mb</li>
                                <li>Image extensions must be JPG/JPEG/PNG/GIF</li>
                            </ul>
                        </div>
                        <div class="text-right">
                                <button type="submit" class="btn px-3 bg-gradient-primary">Update Image</button>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>

        </form>
        <br><br>
        <form action="{{ url('/admin/products/modify') }}" method="POST"   enctype="multipart/form-data">
             @csrf
            <input type="hidden" value="{{ $product->pid }}" name="pid">
            <div class="form-group">
                <label>Product Title</label>
                <span class="text-sm text-danger bold">*
                    @if($errors->has('ptitle'))
                       {{ $errors->first('ptitle') }}
                    @endif
                </span>
                <input type="text" class="form-control" value="{{ $product->ptitle }}" name="ptitle">
            </div>

            <div class="form-group">
                <label>Product Short Description</label>
                <textarea class="advTextarea-no_table form-control"  name="pshortDesc" rows="5"><?= $product->pshortdesc ?></textarea>
            </div>
            <div class="form-group">
                <label>Product Long Description</label>
                <textarea class="advTextarea form-control" rows="5"  name="pDesc"><?= $product->pdesc ?></textarea>
            </div>

            <div class="form-group" >
                  <label>Select Categorie</label>
                  <select class="form-control select2bs4" style="width: 100%;" name="pcate">
                    <?php $categoriesById = DB::table('categories')->where('cate_id',$product->category_id)->get()->toarray(); ?>

                    @if(count($categoriesById) > 0)
                    <option value="{{ $categoriesById[0]->cate_id }}" class="d-none" disabled selected>{{$categoriesById[0]->cate_name}}</option>


                    @endif
                    <option value="" >- NA -</option>


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
                <input type="number" name="price" class="form-control" value="{{ $product->price }}">
            </div>

            <div class="form-group">

                <label>Product M.R.P <sup class="fa fa-rupee-sign"></sup></label>
                <span class="text-sm text-danger bold"> *
                    @if($errors->has('mrp'))
                       {{ $errors->first('mrp') }}
                    @endif
                </span>
                <input type="number" name="mrp" class="form-control" value="{{ $product->MRP }}">
            </div>

            <div class="form-group">
                <label>Product Brand</label>
                <span class="text-sm text-danger bold"> *
                    @if($errors->has('pbrand'))
                       {{ $errors->first('pbrand') }}
                    @endif
                </span>
                <input type="text" name="pbrand" class="form-control" value="{{ $product->brand }}">
            </div>

            <div class="form-group">
                <label>Product Car Model Number</label>
                <span class="text-sm text-danger bold"> *
                    @if($errors->has('pmodel'))
                       {{ $errors->first('pmodel') }}
                    @endif
                </span>
                <input type="text" name="pmodel" class="form-control" value="{{ $product->model }}">
            </div>
            <br><br>
            <div class="text-right">
                  <button type="submit" class="btn px-3 bg-gradient-success">Update</button>
            </div>
        </form>
        @else
            <center><br>
				<img src="{{ asset('img/support/sad.jpg') }}" alt="" class="img-fluid" width="200px">
				<br>
				<h1>Sorry We Unable to find Your product </h1>
				<br>
			</center>
        @endif
    </section>
    <!-- /.content -->


@endsection
