@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Update Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/admin/categories') }}">Categories</a></li>
              <li class="breadcrumb-item active">Update</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
   
   
        <div class="px-5">
        <?php
            $req_cate_id = (isset($_GET['cate_id'])) ? $_GET['cate_id'] : 0;
            $categories = DB::table('categories')->where('cate_id',$req_cate_id)->get()->toarray();
        ?>
        @if(count($categories) > 0)
        <?php $category = $categories[0]; ?>
        <form action="{{ url('/admin/categories/modify/image') }}"  method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $category->cate_id }}" name="cate_id">
            <div class="row">
                <div class="col-md-6">
                <img src="{{ asset( $category->cate_img ) }}" class="img-fluid w-100" style="max-height:400px" alt="">
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Category Image</label>
                        <span class="text-sm text-danger bold">*
                            @if($errors->has('cate_img'))
                            {{ $errors->first('cate_img') }}
                            @endif
                        </span>
                        <div class="custom-file">
                            <input type="file"name="cate_img" value="" id="customFile" accept="image/png, image/jpeg, image/jpg, image/gif">

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

        <form action="{{ url('/admin/categories/modify') }}"  method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $category->cate_id }}" name="cate_id">
            <div class="form-group">
                <label>Category Name</label>
                <span class="text-sm text-danger bold">*
                    @if($errors->has('cate_name'))
                       {{ $errors->first('cate_name') }}
                    @endif
                </span>
                <input type="text" value="{{ $category->cate_name }}" class="form-control" name="cate_name">
            </div>
            <br><br>
            <div class="text-right">
                  <button type="submit" class="btn px-3 bg-gradient-info">Save Categorie</button>
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
        </div>

     
    </section>
    <!-- /.content -->

@endsection
