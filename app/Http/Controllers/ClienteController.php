<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Recibir información
        $texto = TRIM($request->get('texto'));

        // Obtener información por Eloquent
        // $clientes = Cliente::all();

        // Obtener información por paquete DB
        $clientes = DB::table('cliente')
                        ->select('id', 'apellidos', 'nombre', 'documento', 'direccion', 'telefono', 'email')
                        ->where('apellidos', 'LIKE', '%'.$texto.'%') // El comodin porcentaje (%) indica que el texto puede estar al inicio, puede estar al final, o puede estar en el centro de esa columna apellidos
                        ->orWhere('documento', 'LIKE', '%'.$texto.'%')
                        // ->orderBy('apellidos', 'ASC') // Orden de menor a mayor segun columna apellidos, es decir orden alfabético ascendente
                        ->paginate(10);

        // Verificar información
        // Metodo 1
        // return $clientes;

        // Metodo 2
        // error_log(json_encode($clientes)); // Probar usando `tail -f php_errors.log` en la ruta `D:\PORTABLES\laragon\tmp`

        // Metodo 3
        // echo "<pre>";
        // echo json_encode($clientes, JSON_PRETTY_PRINT);
        // echo "</pre>";
        // return;

        // Metodo 4
        // echo "<pre>";
        // print_r($clientes);
        // echo "</pre>";
        // return;

        // Retornar información
        return view('cliente.index', compact('clientes', 'texto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Cliente;
        $cliente->apellidos = $request->input('apellidos');
        $cliente->nombre = $request->input('nombre');
        $cliente->documento = $request->input('documento');
        $cliente->direccion = $request->input('direccion');
        $cliente->telefono = $request->input('telefono');
        $cliente->email = $request->input('email');
        $cliente->save();
        return redirect()->route('cliente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        // return $cliente;
        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->apellidos = $request->input('apellidos');
        $cliente->nombre = $request->input('nombre');
        $cliente->documento = $request->input('documento');
        $cliente->direccion = $request->input('direccion');
        $cliente->telefono = $request->input('telefono');
        $cliente->email = $request->input('email');
        $cliente->save();
        return redirect()->route('cliente.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('cliente.index');
    }
}
