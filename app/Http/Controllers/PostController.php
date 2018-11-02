<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; 
use Log;
use Validator;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /*public function __construct() {
        $this->middleware('auth');
    }*/

    public function api_index()
    {
        return Post::simplePaginate(8);
    }

    public function index()
    {
        //return Post::all();
        /*return view('post',[
            'title' => 'New Title ~~~',
            'posts' => Post::all()
        ]);*/
        return view('post');
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
        
        dd(Auth);
        $validator = Validator::make($request->all(),[
            'title' => 'required|max:10',//規定長度最大為10
            'note'  => 'required',
            'author'=> 'required|integer'//規定必須為整數
        ]);
        if($validator->fails()){
            return ['errors'=>$validator->errors()];
            //return $validator->errors();
        }
        Post::create($request -> all());
        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Post::findOrFail($id); 
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
    public function destroy($id)
    {
        //
    }

    public function post_single($id){
        return view('post_single',[
            'id' => $id
        ]);
    }
}
