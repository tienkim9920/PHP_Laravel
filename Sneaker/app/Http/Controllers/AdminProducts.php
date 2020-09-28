<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;

class AdminProducts extends Controller
{

    private $product;

    public function __construct(Products $product)
    {
        $this->product = $product;
    }

    public function products(){

        $products = Products::all();

        return view('productsAdmin', ['products' => $products]);
    }

    public function create(){
        return view('createProduct');
    }

    public function createProduct(Request $request){

        $product = new Products();

        $product->tenSP = $request->tenSP;

        $product->giaSP = $request->giaSP;
        
        $imgSP1 = $request->file('imgSP1');
        $fileNameImgSP1 = $imgSP1->getClientOriginalName('imgSP1');
        $imgSP1->move('imgProduct', $fileNameImgSP1);
        $product->imgSP1 = '/imgProduct/' . $fileNameImgSP1;

        $imgSP2 = $request->file('imgSP2');
        $fileNameImgSP2 = $imgSP2->getClientOriginalName('imgSP2');
        $imgSP2->move('imgProduct', $fileNameImgSP2);
        $product->imgSP2 = '/imgProduct/' . $fileNameImgSP2;

        $imgSP3 = $request->file('imgSP3');
        $fileNameImgSP3 = $imgSP3->getClientOriginalName('imgSP3');
        $imgSP3->move('imgProduct', $fileNameImgSP3);
        $product->imgSP3 = '/imgProduct/' . $fileNameImgSP3;


        $product->save();

        return redirect('/admin/sanpham/products')->with('createSP', "Bạn Đã Tạo Mới Sản Phẩm Thành Công!");
    }


    public function viewUpdate($id){
        
        $product = Products::where('id', $id)->get();

        return view('updateProduct', ['product' => $product]);
    }

    public function updateProduct(Request $request, $id){

        $product = Products::find($id);

        $product->tenSP = $request->tenSP;

        $product->giaSP = $request->giaSP;

        $imgSP1 = $request->file('imgSP1');
        $fileNameImgSP1 = $imgSP1->getClientOriginalName('imgSP1');
        $imgSP1->move('imgProduct', $fileNameImgSP1);
        $product->imgSP1 = '/imgProduct/' . $fileNameImgSP1;

        $product->save();

        return redirect('/admin/sanpham/products')->with('updateSP', "Bạn Đã Chỉnh Sửa Sản Phẩm Thành Công!");
    }


    public function deleteProduct(Request $request){

        if ($request->ajax()){

            //Delete Product
            $id = $request->get('id');
            $this->product->find($id)->delete();
            
            //Render Product
            $products = $this->product->all();
            $viewProductsData = view('ajax.products-data', compact('products'))->render();
            return response()->json(['viewProductsData' => $viewProductsData ,'code' => 200], 200);
        }

    }
}
