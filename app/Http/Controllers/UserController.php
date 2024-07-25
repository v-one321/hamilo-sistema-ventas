<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit(){
        $item = User::find(auth()->user()->id);
        return view('usuario.edit', compact('item'));
    }
    public function editarDatos(Request $request){
        $usuario_id = auth()->user()->id;
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email,$usuario_id",
            "foto_perfil" => "mimes:png,jpg|max:1024"
        ]);
        $item = User::find($usuario_id);
        $item->name = $request->name;
        $item->email = $request->email;
        if($request->file('foto_perfil')){
            if($item->foto_perfil){
                unlink('fotos/'.$item->foto_perfil);
            }
            $foto = $request->file('foto_perfil');
            $nombreFoto = time().'.png';
            $foto->move("fotos/", $nombreFoto);
            $item->foto_perfil = $nombreFoto;
        }
        $item->save();
        return back()->with('success', 'Datos de usuario modificados');
    }
    public function modificarPassword(Request $request){
        $request->validate([
            "password" => "required|min:8|confirmed",
            "password_confirmation" => "required|min:8",
        ]);
        $item = User::find(auth()->user()->id);
        $item->password = bcrypt($request->password);
        $item->save();
        return back()->with('success', 'Contraseña modificada exitosamente');
    }
}
