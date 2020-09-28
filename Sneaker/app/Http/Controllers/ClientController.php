<?php

namespace App\Http\Controllers;

session_start();

use Illuminate\Http\Request;
use App\Products;
use App\Users;
use App\Carts;
use App\CartsTemp;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    private $product;
    private $user;
    private $cart;
    private $cartTemp;


    public function __construct(Products $product, Users $user, Carts $cart, CartsTemp $cartTemp)
    {
        $this->product = $product;
        $this->user = $user;
        $this->cart = $cart;
        $this->cartTemp = $cartTemp;
    }

    //Index Client
    public function index()
    {


        //Render
        $product = $this->product->all();

        $slice3 = $product->slice(4, 3);

        $sliceSaler = $product->slice(8, 2);

        $sliceTopFuture = $product->slice(5, 2);

        $sliceLatestBlog = $product->slice(2, 3);
        //Render


        //-----Số Lượng Giỏ Hàng------//
        //Giỏ Hàng đã mua của User//
        // $carts = $this->product->where();

        // $_SESSION['user'] = "123";

        $countCart = 0;


        if (isset($_SESSION['user'])) {
            echo "Session User la " . $_SESSION['user'];
        }

        if (!isset($_SESSION['userTemp'])) {
            $_SESSION['userTemp'] = rand(10, 1000);
        }


        $countCart = 0;
        $total = 0;

        if (isset($_SESSION['userTemp'])) {
            $userTemps = $this->cartTemp->where('idUser', $_SESSION['userTemp'])->get();
        }

        foreach ($userTemps as $userTemp) {
            $countCart += $userTemp->count;
            $total += $userTemp->count * $userTemp->priceProduct;
        }


        return view('client.index', [
            'slice3' => $slice3, 'sliceSaler' => $sliceSaler, 'sliceTopFuture' => $sliceTopFuture,

            'sliceLatestBlog' => $sliceLatestBlog, 'countCart' => $countCart, 'carts' => $userTemps, 'total' => $total
        ]);
    }


    //Detail Client
    public function detail($id)
    {

        //Render Chi Tiet San Pham//
        $productDetail = $this->product->where('id', $id)->get();

        $products = $this->product->all();

        $slice8 = $products->slice(3, 8);
        //Render Chi Tiet San Pham//



        //-----Số Lượng Giỏ Hàng------//
        //Giỏ Hàng đã mua của User//
        // $carts = $this->product->where();

        // $_SESSION['user'] = "123";


        $countCart = 0;


        if (isset($_SESSION['user'])) {
            echo "Session User la " . $_SESSION['user'];
        }

        if (isset($_SESSION['userTemp'])) {
            $userTemps = $this->cartTemp->where('idUser', $_SESSION['userTemp'])->get();
        }

        $total = 0;

        foreach ($userTemps as $userTemp) {
            $total += $userTemp->count * $userTemp->priceProduct;
            $countCart += $userTemp->count;
        }



        return view('client.detail', [
            'product' => $productDetail, 'slice8' => $slice8, 'countCart' => $countCart,
            'carts' => $userTemps, 'total' => $total
        ]);
    }


    //Add Product
    public function addProduct(Request $request)
    {
        // echo "This is page AddProduct";
        if ($request->ajax()) {
            // dd($request->all());

            $idProduct = $request->get('id');
            $count = $request->get('count');


            // Add Cart
            $product = $this->product->where('id', $idProduct)->get();

            foreach ($product as $value) {
                $id = $value->id;
                $tenSP = $value->tenSP;
                $giaSP = $value->giaSP;
                $imgSP1 = $value->imgSP1;
            }

            //Tìm những sản phẩm mà User đó mua
            $cartUser = $this->cartTemp->all();

            if (count($cartUser) > 0) {
                $flag = true;

                foreach ($cartUser as $cart) {
                    if ($cart->idProduct == $idProduct) {
                        $count += $cart->count;
                        $idProductUpdate = $cart->id;
                        $flag = false;
                    }
                }

                if (!$flag) {

                    $cart = CartsTemp::findOrFail($idProductUpdate);

                    $cart->count = $count;

                    $cart->save();
                } else {
                    $value = array(
                        'idUser' => $_SESSION['userTemp'], 'idProduct' => $id, 'nameProduct' => $tenSP, 'priceProduct' => $giaSP,
                        'imageProduct' => $imgSP1, 'count' => $count
                    );

                    CartsTemp::insert($value);
                }
            } else {

                $value = array(
                    'idUser' => $_SESSION['userTemp'], 'idProduct' => $id, 'nameProduct' => $tenSP, 'priceProduct' => $giaSP,
                    'imageProduct' => $imgSP1, 'count' => $count
                );

                CartsTemp::insert($value);
            }

            $countCart = 0;

            //Render Product Detail
            if (isset($_SESSION['userTemp'])) {
                $userTemps = $this->cartTemp->where('idUser', $_SESSION['userTemp'])->get();
            }

            foreach ($userTemps as $userTemp) {
                $countCart += $userTemp->count;
            }

            $viewDetailData = view('ajax.detailProduct-data', compact('product'))->render();
            $viewCountCart = view('ajax.countCart-data', compact('countCart'))->render();
            return response()->json(['viewDetailData' => $viewDetailData, 'viewCountCart' => $viewCountCart, 'code' => 200], 200);
        }
    }


    //View Carts
    public function viewCart()
    {

        $countCart = 0;

        $total = 0;

        if (isset($_SESSION['user'])){
            $userTemps = $this->cart->where('idUser', $_SESSION['idUser'])->get();
        }else{
            $userTemps = $this->cartTemp->where('idUser', $_SESSION['userTemp'])->get();
        }

        foreach ($userTemps as $userTemp) {
            $total += $userTemp->count * $userTemp->priceProduct;
            $countCart += $userTemp->count;
        }

        return view('client.cart', ['carts' => $userTemps, 'total' => $total, 'countCart' => $countCart]);

    }


    //Delete Carts
    public function deleteProduct(Request $request)
    {

        if ($request->ajax()) {
            // dd($request->all());

            $id = $request->get('id');
            CartsTemp::find($id)->delete();

            $countCart = 0;

            $total = 0;

            $carts = CartsTemp::where('idUser', $_SESSION['userTemp'])->get();

            foreach ($carts as $cart) {
                $countCart += $cart->count;
                $total += $cart->count * $cart->priceProduct;
            }

            $viewDeleteData = view('ajax.deleteProduct-data', compact('carts', 'total'))->render();
            $viewCountCart = view('ajax.countCart-data', compact('countCart'))->render();
            return response()->json(['viewDeleteData' => $viewDeleteData, 'viewCountCart' => $viewCountCart, 'code' => 200], 200);
        }
    }


    //Change Count Carts
    public function changeCarts(Request $request)
    {
        if ($request->ajax()) {

            $id = $request->get('idChange');
            $countChange = $request->get('countChange');

            CartsTemp::where('id', $id)->update(['count' => $countChange]);


            //Đổ Dữ Liệu Ra Lại View
            $countCart = 0;

            $total = 0;

            //Render ra những sản phẩm mà User đã mua
            $carts = CartsTemp::where('idUser', $_SESSION['userTemp'])->get();

            foreach ($carts as $cart) {
                $countCart += $cart->count;
                $total += $cart->count * $cart->priceProduct;
            }

            $viewChangeData = view('ajax.changeCount-data', compact('carts', 'total'))->render();
            $viewCountCart = view('ajax.countCart-data', compact('countCart'))->render();
            return response()->json(['viewChangeData' => $viewChangeData, 'viewCountCart' => $viewCountCart, 'code' => 200], 200);
        }
    }


    //Get Login
    public function getLogin()
    {

        unset($_SESSION['user']);
        unset($_SESSION['idUser']);

        $countCart = 0;

        // if (isset($_SESSION['user'])){
        //     echo "Session User la " . $_SESSION['user'];
        // }

        if (isset($_SESSION['userTemp'])) {
            $userTemps = $this->cartTemp->where('idUser', $_SESSION['userTemp'])->get();
        }

        $total = 0;

        foreach ($userTemps as $userTemp) {
            $total += $userTemp->count * $userTemp->priceProduct;
            $countCart += $userTemp->count;
        }

        return view('client.login', [
            'countCart' => $countCart,
            'carts' => $userTemps, 'total' => $total
        ]);
    }

    //Post Login
    public function postLogin(Request $request)
    {

        //Render
        if (isset($_SESSION['userTemp'])) {
            $userTemps = $this->cartTemp->where('idUser', $_SESSION['userTemp'])->get();
        }

        $countCart = 0;
        $total = 0;

        foreach ($userTemps as $userTemp) {
            $total += $userTemp->count * $userTemp->priceProduct;
            $countCart += $userTemp->count;
        }
        //Render

        $email = $request->email;
        $password = $request->password;

        $user = Users::where('email', $email)->get();

        if ($user->isEmpty()) {

            return view('client.login', [
                'emailError' => "* Vùi Lòng Kiểm Tra Lại Email!", 'countCart' => $countCart,
                'carts' => $userTemps, 'total' => $total
            ]);
        } else {
            if (Hash::check($password, $user[0]->password)) {

                $_SESSION['user'] = $user[0]->fullname;
                $_SESSION['idUser'] = $user[0]->id;

                //Push Cart vào Database mà User đã login
                foreach ($userTemps as $userTemp){

                    $idUser = $user[0]->id;
                    $idProduct = $userTemp->idProduct;
                    $nameProduct = $userTemp->nameProduct;
                    $priceProduct = $userTemp->priceProduct;
                    $imageProduct = $userTemp->imageProduct;
                    $count = $userTemp->count;

                    $value = array(
                        'idUser' => $idUser, 'idProduct' => $idProduct, 'nameProduct' => $nameProduct, 'priceProduct' => $priceProduct,
                        'imageProduct' => $imageProduct, 'count' => $count
                    );

                    Carts::insert($value);
                    CartsTemp::find($userTemp->id)->delete();

                }

                return redirect('/client/carts');

            } else {
                return view('client.login', [
                    'passwordError' => "* Vui Lòng Kiểm Tra Lại Password!", 'countCart' => $countCart,
                    'carts' => $userTemps, 'total' => $total
                ]);
            }
        }
    }


    //Get Register
    public function getRegister()
    {
        return view('client.register');
    }


    //Check Order
    public function checkOrder(Request $request)
    {
        if ($request->ajax()) {

            $id = $request->get('id');

            $carts = CartsTemp::where('idUser', $id)->get();

            if (count($carts) > 0) {
                //Đổ Dữ Liệu Ra Lại View
                $countCart = 0;

                $total = 0;

                foreach ($carts as $cart) {
                    $countCart += $cart->count;
                    $total += $cart->count * $cart->priceProduct;
                }

                $viewChangeData = view('ajax.changeCount-data', compact('carts', 'total'))->render();
                $viewCountCart = view('ajax.countCart-data', compact('countCart'))->render();
                return response()->json(['viewChangeData' => $viewChangeData, 'viewCountCart' => $viewCountCart, 'code' => 200], 200);
            } 
        }
    }


    //View Order
    public function viewOrder(){
        $countCart = 0;

        $total = 0;

        $userCarts = $this->cart->where('idUser', $_SESSION['idUser'])->get();

        foreach ($userCarts as $userCart) {
            $total += $userCart->count * $userCart->priceProduct;
            $countCart += $userCart->count;
        }

        return view('client.checkout', ['carts' => $userCarts, 'total' => $total, 'countCart' => $countCart]);
    }


}
