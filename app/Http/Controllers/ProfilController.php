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
        $user = User::find($id);
        $user->name = $request->nama_user;
        $user->save();
        return redirect('/profil');
        
    }

    
    public function destroy($id)
    {
        //
    }
}