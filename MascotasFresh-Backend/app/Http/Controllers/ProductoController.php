<?php

namespace App\Http\Controllers;

use App\Producto;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allProducts = Producto::all();
        return ['productos'=> $allProducts];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $producto= Producto::create([
            'nombre'=> $request->nombre,
            'cantidad'=> $request->cantidad,
            'precio'=> $request->precio,
            'lote'=> $request->lote,
            'creado'=> $request->creado,
            'vencimiento' => $request->vencimiento,
        ]);
        return response()->json(["success"=>true,
                                 "message" =>'producto creado',
                                 "usuario" => $producto],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        try {
            $user = Producto::findOrFail($request->id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Producto no conseguido.'
            ], 403);
        }

        $user->update($request->all());

        return response()->json(['message'=>'Producto actualizado']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        try {
            $product = Producto::findOrFail($request->id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => ' No se consigue producto para eleminar.'
            ], 403);
        }

        $product->delete();

        return response()->json(['message'=>'Producto Eliminado.']);
    }
}
