<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::all();
        return view('page/master/data-user',['user'=>$user]);
    }


    protected function store(Request $request)
    {
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level'=> $request->level,
        ]);


    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect('/data-user')->flash('success',"Category Deleted Successfully!!");;
    }
}
