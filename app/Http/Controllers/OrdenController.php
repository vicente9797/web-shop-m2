<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Orden;
use App\Models\OrdenDetalles;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OrdenController
{
    public function index()
    {

        $ordenes = Orden::where('user_id', auth()->user()->id)->get();

        $ordenDetalles = OrdenDetalles::whereIn('order_id', $ordenes->pluck('id'))
            ->join('productos', 'order_details.producto_id', '=', 'productos.id')
            ->get();

        $ordenes = $ordenes->map(function ($orden) use ($ordenDetalles) {
            $orden->detalles = $ordenDetalles->where('order_id',$orden->id);
            return $orden;
        });

        return view('orden', ['user' => auth()->user(), 'ordenes' => $ordenes]);
    }

    public function generarOrden()
    {
        try {
            DB::beginTransaction();

            $carrito = Carrito::where('user_id', auth()->user()->id)
                ->join('productos', 'carrito.producto_id', '=', 'productos.id')
                ->get();

            if ($carrito->isEmpty()) {
                throw ValidationException::withMessages(['error' => 'No hay productos en el carrito.']);
            }

            $total = $carrito->sum(function ($item) {
                return $item->precio * $item->cantidad;
            });

            $orden = Orden::create([
                'user_id' => auth()->user()->id,
                'transaction_number' => Str::uuid(),
                'payment_confirmation' => true,
                'total' => $total,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $ordenDetalles = $carrito->map(function ($item) use ($orden) {
                return [
                    'order_id' => $orden->id,
                    'producto_id' => $item->producto_id,
                    'cantidad' => $item->cantidad,
                    'precio' => $item->precio,
                ];
            });


            OrdenDetalles::insert($ordenDetalles->toArray());

            Carrito::where('user_id', auth()->user()->id)->delete();

            DB::commit();

            return redirect()->route('orden')->with('success', 'La orden ha sido generada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('carrito')->with('error', 'Ha ocurrido un error al generar la orden: ' . $e->getMessage());
        }
    }

}
