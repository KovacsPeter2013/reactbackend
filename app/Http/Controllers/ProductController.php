<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use Validator;

class ProductController extends Controller{
    




    public function addProduct(Request $req){   	  	
     

    	$fileArray = array('image' => $req->file);
    	$rules = array(
    		'image' => 'image|required|max:20000'
    	);

    	$validator = Validator::make($fileArray, $rules);

    	if ($validator->fails()) {
    		
    		return "Invalid fájl";

    	}else{  


        $product = new Product();  
    	$product->name = $req->input("name");
    	$product->price = $req->input("price");
    	$product->description = $req->input("description");
    	$product->file_path = $req->file("file")->store("products");
    	}


    	$product->save();
    	//return $product;
    	//var_dump( $_FILES);
    }



    public function list(){

    	return Product::all();
    }



    public function delete($id){

    	$result = Product::where('id', $id)->delete();

    	if ($result) {
    		
    		return["result" => "Sikeres törlés"];

    	}else{

    		return["result" => "Sikertelen törlés"];

    	}
    }




    public function getProduct($id){

    	$result =  Product::find($id);

    	if ($result) {
    		
    		return $result;
    	}else{

    		return "Nem létező ID";

    	}
    }


    public function update(Request $req, $id){

    	$product = Product::find($id);
        //$product->name = $req->input("name");
    	return $product;
    	//$product->name = $req->input("name");
    	//$product->price = $req->input("price");
    	//$product->description = $req->input("description");
    	//$product->save();
    }








    public function Search($key){

    $result =   Product::where('name', 'Like', "%$key%")->get();
    return $result;
    }

}
