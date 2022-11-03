<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::all();  //traigo todos los registros de la BD

        return response()->json($clientes); //puedo ponerlo asi, o de la siguiente manera
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = Cliente::create([    //Crea un cliente c/el atributo nombre con ese valor que tiene nombre
            'nombre' => $request['nombre'], //el nombre de la derecha es el mismo campo que la BD
            'telefono' => $request['telefono']
        ]);
        $details = [
            'title' => 'Se ha registrado una nueva RESERVA: ',
            'body' => $cliente->nombre
        ];

        Mail::to('XXXXXXXXX@hotmail.com')->send(new ContactEmail($details));

        return response([
            'mensaje' => 'LA RESERVA AL RESTAURANTE , SE REALIZO CORRECTAMENTE',
            'data' => $cliente
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $id)
    {
        $cliente = Cliente::findorFail($id);

        $cliente->nombre = $request['nombre'];

        $cliente->save();

        return response()->json([
            'mensaje' => 'La actualizacion se realizo correctamente',
            'data' => $cliente
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $id)
    {
        //Elimino Clientes
        $cliente = Cliente::findorFail($id);
        $cliente->delete();

        return response()->json([
            'mensaje' => 'Se ha desactivado correctamente la reserva del cliente',
            'data' => $cliente
        ], 200);
    }

    public function restore(int $id)
    {
        $cliente = Cliente::withTrashed()
            ->where('id', $id)
            ->restore();

        return response()->json([
            'mensaje' => $cliente ? 'Se ha REACTIVADO correctamente el cliente' : 'Hubo un ERROR al intentar reactivar el registro',
        ], 200);
    }
}