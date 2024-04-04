<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|string|email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->nombre,
            'email' => $request->correo,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', '¡Registro exitoso! Por favor inicia sesión.');
    }
}
