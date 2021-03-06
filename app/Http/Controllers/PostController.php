<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post; 
use Log;
use Validator;
use Auth;
use DB;
use App\Chat;
use Input;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct() {
        //$this->middleware('auth');
    }

    public function api_index()
    {
        
        return Post::simplePaginate(4);
    }

    public function index()
    {
        //return Post::all();
        /*return view('post',[
            'title' => 'New Title ~~~',
            'posts' => Post::all()
        ]);*/
        /*$posts = DB::table('posts')->paginate(4);
        return view('post', ['posts' => $posts]);*/
        return view('post');
        /*$author = Auth::user()->id;
        $users = Chat::all();
        foreach($users as $user){
            $user->author = $user->author()->first()->name;
        }
        return $user;*/
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
        /*$validator = Validator::make($request->all(),[
            'title' => 'required|max:10',//規定長度最大為10
            'note'  => 'required',
            //'author'=> 'required|integer',//規定必須為整數
            
        ]);
        if($validator->fails()){
            return ['errors'=>$validator->errors()];
            //return $validator->errors();
        }
        $request->all()->author = 1;
        dd($request->all());
        Post::create($request->all());*/

        $input = $request->all();
        $rules = [
            'title' => 'required|max:10',
            'note'  => 'required|min:2'
        ];
        $validator = Validator::make($input,$rules);
        if($validator->passes()){
            $posts = new Post;
            $posts->title = $input['title'];
            $posts->note = $input['note'];
            $posts->author = Auth::user()->id;
            $posts->save();     //將資料新增置資料庫，就不用再Post::create
        }

        if($validator->fails()){
            return ['errors'=>$validator->errors()];
            //return $validator->errors();
        }

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
        $auts = Post::findOrFail($id);
        
        $auts->author = $auts->author()->first()->name;
        
        return $auts; 
    }

    public function test()
    {
        $author = Auth::user();
        return $author;
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
        Post::destroy($id);
        return redirect('/posts');
    }

    public function post_single($id){
        return view('post_single',[
            'id' => $id
        ]);
    }
}
