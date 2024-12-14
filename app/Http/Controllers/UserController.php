<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     */
    public function index()
    {

        $user = User::paginate(8);
        return view('user.index', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id); 
        $user->delete();
        
        $notification = [
            'message' => 'Data user berhasil dihapus',
            'alert-type' => 'success'
        ];
    
        return redirect()->route('user.index')->with($notification);
    }
}
