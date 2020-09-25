<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;


class productsController extends Controller
{
    function get_model_numbers_by_group_print_select(Request $Request){
    	$brandname = strip_tags($Request->brand);

    	$brandname = $brandname ?? "0";

    	$brandname = str_replace('%', "", $brandname);
    	$brandname = str_replace('=', "", $brandname);
    	$brandname = str_replace('*', "", $brandname);

    	$brandname = $brandname ?? "0";

    	$productsModels = Product::where('brand',$brandname)->select('model')->groupby("model")->get();

    	?>
    		<select  name="model" class="w-100 custom-select  form-control"><option value='' disabled hidden  selected>Select Model Line</option>
    	<?php
	    	foreach ($productsModels as $model) {
	    		echo "<option>".$model['model']."</option>";
	    	}
    	?> </select>
    	<?php
    }



    function show_all_products(){
        $products = Product::paginate(10);

        return view('customer.products',['products'=>$products]);
    }

    function show_products_by_car(Request $Request){
        $Request->validate([
            'brand' => "required",
        ]);

        if($Request->model != ""){
            $products = Product::where([
                "brand"     =>  str_replace("=", "", strip_tags($Request->brand)),
                "model"     =>  str_replace("=", "", strip_tags($Request->model)),
            ])->paginate(10);
        }else{
            $products = Product::where([
                "brand"     =>  str_replace("=", "", strip_tags($Request->brand)),
            ])->paginate(10);
        }



        return view('customer.products',['products'=>$products]);
    }

    function show_products_by_Category(Request $Request){
         $Request->validate([
            'cate_id' => "required",
        ]);

         $products = Product::where("category_id",str_replace('=', "", strip_tags($Request->cate_id)))->paginate(10);

        return view('customer.products',['products'=>$products]);

    }


    function show_products_by_search(Request $Request){
        $Request->validate([
            'search_cri' => "required",
        ]);

        $products = Product::where("ptitle","like","%".str_replace("=", "", strip_tags($Request->search_cri))."%",)->paginate(10);

        return view('customer.products',['products'=>$products]);
    }



    function get_product_in_quick_view(Request $Request){
        $Request->validate([
            'pid' => "required",
        ]);

         $products = Product::where("pid",str_replace("=", "", strip_tags($Request->pid)))->paginate(10);


         if($products){

            foreach($products as $product){
                ?>

                    <div class="text-center">
                        <img src="<?= asset('/').$product->pimage ?>"   class="card-img" style="height:200px;">
                    </div>
                    <br>
                    <p><?= $product->ptitle ?></p>
                    <h6 class="text-success bold"
                    >Price
                    <?php if(isset($_COOKIE['curr'])): ?>
                    <?php   if($_COOKIE['curr'] == "INR"): ?>
                            Rs. <?= number_format($product->price,2) ?> &nbsp&nbsp 
                            <del class="text-danger">
                                RS. <?= number_format($product->MRP,2) ?>
                            </del></h6>
                    <?php  elseif($_COOKIE['curr'] == "USD"): ?>
                            $ <?= number_format($product->price / 74,2) ?> &nbsp&nbsp 
                            <del class="text-danger">
                                $ <?= number_format($product->MRP / 74,2) ?>
                            </del></h6>
                    <?php   endif; ?>
                    <?php   else: ?>
                    Rs. <?= number_format($product->price,2) ?> &nbsp&nbsp 
                    <del class="text-danger">Rs. <?= number_format($product->MRP,2) ?></del></h6>
                    <?php endif; ?>
                    <br><br>
                    <h6 class="bold text-primary">
                        Product Info
                    </h4>
                    <br>

                    <p><?= $product->pshortdesc ?></p>
                    <br>
                     <table class="table table-borderless ">
                       <tr>
                            <th>Brand</th>
                            <td><?= $product->brand ?></td>
                       </tr>
                       <tr>
                            <th>Model</th>
                            <td><?= $product->model ?></td>
                       </tr>
                    </table>
                    <br><br>
                    <a href="<?= url('/products/open?pid=').$product->pid ?>" class="btn btn-info">View more</a>


                <?php
            }


         }else{
             ?>

            <center><br>
                <img src="{{ asset('img/support/sad.jpg') }}" alt="" class="img-fluid" width="100px">
                <br>
                <h1>Sorry We Unable to find Your product </h1>
                <br>
            </center>

             <?php
         }
    }






    // admin program


    function saveProduct(Request $Request){
        $Request->validate([
            "pimage"        =>  "required |image|mimes:jpeg,png,jpg,gif|max:5000",
            "ptitle"        =>  "required | min:5 | max:150",
            "price"     =>  "required | integer | gt:0",
            "mrp"       =>  "required | integer | gt:0",
            "pbrand"        =>  "required | min:1",
            "pmodel"        =>  "required | min:1",


        ],[],[

                "pimage"        =>  "Product Image",
                "ptitle"        =>  "Product Title",
                "price"     =>  "Product Price",
                "mrp"       =>  "Product M.R.P",
                "pbrand"        =>  "Brand Name",
                "pmodel"        =>  "Model Number",



        ]);

        $file = $Request->pimage;
        $file_name = date('Y_M_D_').sha1(md5(sha1("upload_image".date('YYMMDDYYHhhhiiss').mt_rand(59999,99999)))).$file->getClientOriginalName();
        $upload_path = 'public/img/products';
        $file->move($upload_path, $file_name);

        Product::insert([
            "pimage" =>   "img/products/".$file_name,
            "ptitle" =>  $Request->ptitle,
            "price" =>  $Request->price,
            "MRP" =>  $Request->mrp,
            "brand" =>  $Request->pbrand,
            "model" =>  $Request->pmodel,
            "pshortdesc" =>  $Request->pshortDesc,
            "pdesc" =>  $Request->pDesc,
            "category_id" => $Request->pcate,

        ]);

        return redirect('admin/products');

    }

    function modifyProduct(Request $Request){
        $Request->validate([
            "pid"        =>  "required",
            "ptitle"        =>  "required | min:5 | max:150",
            "price"     =>  "required | integer | gt:0",
            "mrp"       =>  "required | integer | gt:0",
            "pbrand"        =>  "required | min:1",
            "pmodel"        =>  "required | min:1",


        ],[],[


            "ptitle"        =>  "Product Title",
            "price"     =>  "Product Price",
            "mrp"       =>  "Product M.R.P",
            "pbrand"        =>  "Brand Name",
            "pmodel"        =>  "Model Number",


        ]);

        $productDetails = Product::where('pid',$Request->pid)->get();

        if (count($productDetails) > 0) {
            Product::where('pid', $Request->pid)->update([

                "ptitle" =>  $Request->ptitle,
                "price" =>  $Request->price,
                "MRP" =>  $Request->mrp,
                "brand" =>  $Request->pbrand,
                "model" =>  $Request->pmodel,
                "pshortdesc" =>  $Request->pshortDesc,
                "pdesc" =>  $Request->pDesc,
                "category_id" => $Request->pcate,

            ]);
        }

        return redirect('admin/products/modify?pid='.$Request->pid);

    }

    function modifyProductImage(Request $Request){
        $Request->validate([
            'pid'       =>  'required',
            "pimage"        =>  "required |image|mimes:jpeg,png,jpg,gif|max:5000",
        ],[],[
            "pimage"        =>  "Product Image",
        ]);

        $productDetails = Product::where('pid',$Request->pid)->get()->toarray();

        if(count($productDetails) > 0){
            $preimage = $productDetails[0]['pimage'];


            if(file_exists(public_path($preimage))){
                unlink(public_path($preimage));
            }


            $file = $Request->pimage;
            $file_name = date('Y_M_D_').sha1(md5(sha1("upload_image".date('YYMMDDYYHhhhiiss').mt_rand(59999,99999)))).$file->getClientOriginalName();
            $upload_path = 'public/img/products';
            $file->move($upload_path, $file_name);

            Product::where('pid', $Request->pid)->update([
                'pimage' => "img/products/".$file_name
            ]);

        }

        return redirect('admin/products/modify?pid='.$Request->pid);



    }


    function deleteProduct(Request $Request){
        $Request->validate([
            'pid'       =>  'required',

        ]);

        $productDetails = Product::where('pid',$Request->pid)->get()->toarray();
        if(count($productDetails) > 0){
            $preimage = $productDetails[0]['pimage'];


            if(file_exists(public_path($preimage))){
                unlink(public_path($preimage));
            }

            Product::where('pid',$Request->pid)->delete();
        }
        return redirect('admin/products');
    }

}
