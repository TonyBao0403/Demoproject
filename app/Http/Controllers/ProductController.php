<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;  //待驗證~~~
use App\Product;
use Session;
use DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        return Product::all();
    }


     public function list()
    {
        return view('product-list');
    }

    
    public function add_cart(Request $request, $id, $sum){
            $pro = $request->session()->get('cart_pro');
            $amo = $request->session()->get('cart_amo');
            $arr_pro = [];
            $arr_amo = [];
            $i=0;
            $x = true;
            if($pro != null){
                $arr_pro = json_decode($pro);
                $arr_amo = json_decode($amo);
            }
            for($i=0;$i<count($arr_pro);$i++){
                if($arr_pro[$i]==$id) {
                    $x = false;
                    break;
                }
            }

            if($x == false) {
                $arr_amo[$i] += $sum;
                $request->session()->put('cart_amo',json_encode($arr_amo));
            }
            else{
                $arr_pro[$i] = $id;
                $arr_amo[$i] = $sum; 
                $request->session()->put('cart_pro',json_encode($arr_pro));
                $request->session()->put('cart_amo',json_encode($arr_amo));
            }


            /*$pro = $request->session()->get('cart');
            $arr = [];
            if($pro != null){
                $arr = json_decode($pro);
            }
            $arr[] = $id;
            $request->session()->put('cart',json_encode($arr));*/

            return [
                'status' => true,
                'cart_pro' => $request->session()->put('cart_pro',json_encode($arr_pro)),
                'cart_amo' => $request->session()->put('cart_amo',json_encode($arr_amo)),
                'arr_pro'  => $arr_pro
            ];
        
        
    }


    public function list_cart(Request $request){
        $pro_list = json_decode($request->session()->get('cart_pro'));
        $amo_list = json_decode($request->session()->get('cart_amo'));
        $prod_list = [];
        foreach($pro_list as $id){
            $prod_list[] = Product::find($id);
        }
        
        for($i=0;$i<count($pro_list);$i++)
        {
            $prod_list[$i]["price"] = $prod_list[$i]["price"] * $amo_list[$i];
            $prod_list[$i]["amount"] = $amo_list[$i];
        }
        return $prod_list;
    }


    public function cart(){
        return view('cart');
    }

    public function test(Request $request){
        
        DB::table('products')->insert([
            'name' => 'Tony',
            'amount' => null,
            'price' => 999
        ]);
        
        /*DB::table('products')
                ->where('name','Tony')
                ->delete();*/

        return redirect('/products');
    }
    public function test2(){
        //$test = ['jack','tony','hadnsome'];
        $product = array([1,2,3,4]);
        Session::push('cart', $product);
        $value = Session::get('cart');
        dd($value);
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {   
        $pro_list = json_decode($request->session()->get('cart_pro'));
        $amo_list = json_decode($request->session()->get('cart_amo'));
        //$pro_list[4]= 0;
        $amo_list[4] += 6;
        //$request->session()->put('cart_pro',json_encode($pro_list));
        $request->session()->put('cart_amo',json_encode($amo_list));
        //Session::forget($amo_list[0]);
        //return view('cart');
        dd($amo_list);
    }
}
