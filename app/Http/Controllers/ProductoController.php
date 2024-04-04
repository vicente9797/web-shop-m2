<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class ProductoController
{
    public function index()
    {
        $productos = DB::Table('productos')->get();
        $user = Auth()->user();

        $productosEnCarrito = DB::table('carrito')
            ->where('user_id', $user->id)
            ->pluck('producto_id')
            ->toArray();

        $tieneProductosEnCarrito = !empty($productosEnCarrito);

        return view('productos', [
            'productos' => $productos,
            'user' => $user,
            'productosEnCarrito' => $productosEnCarrito,
            'tieneProductosEnCarrito' => $tieneProductosEnCarrito,
        ]);
    }

}
