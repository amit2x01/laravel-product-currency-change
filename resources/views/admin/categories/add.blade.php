@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add New Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ url('/admin/categories') }}">Categories</a></li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
   
   
        <div class="px-5">
            <form action="{{ url('/admin/categories/add') }}"  method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Category Image</label>
                <span class="text-sm text-danger bold">*
                    @if($errors->has('cate_image'))
                       {{ $errors->first('cate_image') }}
                    @endif
                </span>
                <div class="custom-file">
                    <input type="file"name="cate_image" id="customFile" accept="image/png, image/jpeg, image/jpg, image/gif">

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
                <label>Category Name</label>
                <span class="text-sm text-danger bold">*
                    @if($errors->has('cate_name'))
                       {{ $errors->first('cate_name') }}
                    @endif
                </span>
                <input type="text" class="form-control" name="cate_name">
            </div>
            <br><br>
            <div class="text-right">
                  <button type="submit" class="btn px-3 bg-gradient-info">Save Categorie</button>
            </div>
            </form>
        </div>

     
    </section>
    <!-- /.content -->

@endsection
