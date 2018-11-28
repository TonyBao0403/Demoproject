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
            $pro = session()->get('cart_pro');
            $amo = session()->get('cart_amo');
            $arr_pro = [];
            $arr_amo = [];
            $i=0;
            $x = true;
            if($pro != null){
                $arr_pro = $pro;
                $arr_amo = $amo;
            }
            for($i=0;$i<count($arr_pro);$i++){
                if($arr_pro[$i]==$id) {
                    $x = false;
                    break;
                }
            }
 
            if($x == false) {
                $arr_amo[$i] += $sum;
                $request->session()->put('cart_amo',$arr_amo);
            }
            else{
                $arr_pro[$i] = $id;
                $arr_amo[$i] = $sum; 
                $request->session()->put('cart_pro',$arr_pro);
                $request->session()->put('cart_amo',$arr_amo);
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
                'cart_pro' => session()->put('cart_pro',$arr_pro),
                'cart_amo' => session()->put('cart_amo',$arr_amo),
                'arr_pro'  => $arr_pro
            ];
        
        
    }


    public function list_cart(Request $request){
        $pro_list = session()->get('cart_pro');
        $amo_list = session()->get('cart_amo');
        $prod_list = [];
        foreach($pro_list as $id){
            $prod_list[] = Product::find($id);
        }
        
        for($i=0;$i<count($pro_list);$i++)
        {
            //$prod_list[$i]["price"] = $prod_list[$i]["price"] * $amo_list[$i];            //計算單項產品總額，目前挪到前端去運算。
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
        $test = ['jack','tony','hadnsome'];
        $product = array([1,2,3,4]);
        Session::push('cart', $test);
        $value = Session::get('cart');
        //dd($value);
        dd(session()->all());
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
        $pro_list = session()->get('cart_pro');
        $amo_list = session()->get('cart_amo');
        $del_value = $id;
        unset($pro_list[array_search($del_value,$pro_list)]);           //刪除陣列某一屬性
        unset($amo_list[array_search($del_value,$amo_list)]);
        $pro_list = array_values($pro_list);            //重新編排陣列，往前移
        $amo_list = array_values($amo_list);
        session()->put('cart_pro',$pro_list);           //更新session
        session()->put('cart_amo',$amo_list);

        return redirect('/cart');
        //dd($pro_list);
    }
}
