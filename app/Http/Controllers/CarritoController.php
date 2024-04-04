<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $producto = Producto::findOrFail($request->input('producto_id'));

        $item = new Carrito([
            'user_id' => auth()->user()->id,
            'producto_id' => $producto->id,
            'cantidad' => 1,
        ]);

        $item->save();

        return redirect()->route('productos')->with('success', 'El producto se ha agregado al carrito.');
    }

    public function ver()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $productosAgregadosAlCarrito = Carrito::where('user_id', auth()->user()->id)
            ->join('productos', 'carrito.producto_id', '=', 'productos.id')
            ->get();
        return view('carrito', ['productos' => $productosAgregadosAlCarrito,'user' => auth()->user()]);
    }

    public function eliminar(Request $request)
    {
        $user_id = auth()->user()->id;
        $producto_id = $request->input('producto_id');

        Carrito::where('user_id', $user_id)
            ->where('producto_id', $producto_id)
            ->delete();

        return redirect()->route('carrito')->with('success', 'El producto ha sido eliminado del carrito.');
    }
}

