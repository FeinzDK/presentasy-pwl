<?php

namespace App\Http\Controllers;

use App\Models\User; 
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index()
    {

        $anggota = User::paginate(8);  
        return view('anggota.index', compact('anggota')); 
    }

    public function destroy($id)
    {
        $anggota = User::findOrFail($id);  
        $anggota->delete();  
        

        $notification = [
            'message' => 'Data anggota berhasil dihapus',
            'alert-type' => 'success'
        ];
    
        return redirect()->route('anggota.index')->with($notification);  
    }
}
