<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('page/profil',['user'=>$user]);
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_user' => ['required', 'string', 'max:255'],
            'password_new' => ['required', 'string', 'min:8'],
        ]);
        $user = User::find($id);
        $user->name = $request->nama_user;

        if($request->password_new == true){
            $user->password = Hash::make($request->password_new);
        }else{

        }
        $user->save();
        return redirect('/data-user')->with('success',"Profil Berhasil di Update");
        
    }

    
    public function destroy($id)
    {
        //
    }
}
