<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Category;

class categoryController extends Controller
{
    function saveCategory(Request $Request){
    	$Request->validate([
    		"cate_image"        =>  "required |image|mimes:jpeg,png,jpg,gif|max:5000",
            "cate_name"        =>  "required | min:5 | max:150",
        ],[],[
            "cate_image"        =>  "Category Image",
            "cate_name"        =>  "Category Name"
        ]);

        $file = $Request->cate_image;
        $file_name = date('Y_M_D_').sha1(md5(sha1("upload_image".date('YYMMDDYYHhhhiiss').mt_rand(59999,99999)))).$file->getClientOriginalName();
        $upload_path = 'public/img/categories';
        $file->move($upload_path, $file_name);

        Category::insert([
            'cate_img'  => "img/categories/". $file_name,
            'cate_name'  =>  $Request->cate_name,
        ]);


        return redirect('/admin/categories');
    }



    function modifyCategoryImage(Request $Request){
        $Request->validate([
            'cate_id'       =>  'required',
            "cate_img"        =>  "required |image|mimes:jpeg,png,jpg,gif|max:5000",
        ],[],[
            "cate_img"        =>  "Category Image",
        ]);

        $categorieDetails = Category::where('cate_id',$Request->cate_id)->get()->toarray();

        if(count($categorieDetails) > 0){
            $preimage = $categorieDetails[0]['cate_img'];


            if(file_exists(public_path($preimage))){
                unlink(public_path($preimage));
            }


            $file = $Request->cate_img;
            $file_name = date('Y_M_D_').sha1(md5(sha1("upload_image".date('YYMMDDYYHhhhiiss').mt_rand(59999,99999)))).$file->getClientOriginalName();
            $upload_path = 'public/img/categories';
            $file->move($upload_path, $file_name);

            Category::where('cate_id', $Request->cate_id)->update([
                'cate_img' => "img/categories/".$file_name
            ]);

        }

        return redirect('admin/categories/modify?cate_id='.$Request->cate_id);

    }


    function modifyCategory(Request $Request){
        $cate_id = $Request->cate_id;
        $Request->validate([
            'cate_id'       =>  'required',
            "cate_name"        =>  "required | unique:categories,cate_name,${cate_id},cate_id",
        ],[],[
            "cate_name"        =>  "Category Name",
        ]);

        $categorieDetails = Category::where('cate_id',$Request->cate_id)->get()->toarray();

        if(count($categorieDetails) > 0){
            
            Category::where('cate_id', $Request->cate_id)->update([
                'cate_name' => $Request->cate_name,
            ]);

        }

        return redirect('admin/categories/modify?cate_id='.$Request->cate_id);

    }


    function deletecategory(Request $Request){
        $Request->validate([
            'cate_id'       =>  'required',

        ]);

        $categorieDetails = Category::where('cate_id',$Request->cate_id)->get()->toarray();
        if(count($categorieDetails) > 0){
            $preimage = $categorieDetails[0]['cate_img'];


            if(file_exists(public_path($preimage))){
                unlink(public_path($preimage));
            }

            Category::where('cate_id',$Request->cate_id)->delete();
        }
        return redirect('admin/categories');
    }
   

    
}
