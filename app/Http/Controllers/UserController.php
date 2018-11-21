<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        //$this->middleware('auth');
        return true;
    }

    public function api_index()
    {
        return User::simplePaginate(4);
    }

    public function index()
    {
        $users = DB::table('users')->paginate(4);
        return view('user', ['users' => $users]);
        /*return view('user',[
            'users' => User::all()
        ]);*/
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
            'name' => 'required|max:10',
            'email'  => 'required|unique:users',
            'password'=> 'required|confirmed'
        ]);
        dd($request->all());
        if($validator->fails()){
            return redirect('/user')
                    ->withErrors($validator)
                    ->withInput();
        }
        User::create($request -> all());*/

        $input = $request->all();
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ];
        $validator = Validator::make($input,$rules);
        if($validator -> passes()){
            $user = new User;
            $user->name = $input['name'];
            $user->email = $input['email'];
            $user->password = bcrypt($input['password']);
            $user->save();
        }
        if($validator->fails()){
            return redirect('/user')
                    ->withErrors($validator)
                    ->withInput();
        }

        return redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        User::destroy($id);
        return redirect('/user');
        //return redirect()->action('UserController@index');
    }
}
