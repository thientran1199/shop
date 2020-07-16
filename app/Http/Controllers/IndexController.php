<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use App\Models\ImageGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('frontEnd.index', compact('products'));

    }
    public function shop(){
        $products = Product::all();
        $byCate = "";
        return view('frontEnd.products', compact('products','byCate'));
    }
    public function listByCat($id){
        $list_product = Product::where('categories_id', $id)->get();
        $byCate = Category::select('name')->where('id', $id)->first();
        return view('frontEnd.products',compact('list_product','byCate'));
    }
    public function detialpro($id){
        $detail_product = Product::findOrFail($id);
        $imagesGalleries = ImageGallery::where('products_id',$id)->get();
        $relateProducts = Product::where([['id','!=',$id],['categories_id',$detail_product->categories_id]])->get();
        return view('frontEnd.product_details',compact('detail_product','imagesGalleries','relateProducts'));
    }

}
