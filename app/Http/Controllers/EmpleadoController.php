<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['empleados'] = Empleado::all();
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Recibimos todos los datos
        // $datosEmpleado = request()->all();

        // Recibimos todos los datos exepto el token
        $datosEmpleado = request()->except('_token');
        
        // Verifico si hay una foto y guardo en carpeta uploads
        if($request->hasFile('foto')){
            $datosEmpleado['foto'] = $request->file('foto')->store('uploads','public');
        }
        
        // Inserto en base de datos
        Empleado::insert($datosEmpleado);


        // return response()->json($datosEmpleado);
        return redirect('empleado')->with('mensaje', 'Empleado agregado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $empleado = Empleado::findOrFail($id);

        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Recepcionamos datos sin el token y el method
        $datosEmpleado = request()->except(['_token','_method']);


        // Verifico si hay foto para subir 
        if($request->hasFile('foto')){
            // Si lo hay, busco el empleado con el id para obtener la foto vieja
            $empleado = Empleado::findOrFail($id);
            // Luego borro la foto vieja del empleado de la carpeta public
            Storage::delete('public/'.$empleado->foto);
            // guardo la nueva foto en la carpeta public
            $datosEmpleado['foto'] = $request->file('foto')->store('uploads','public');
        }


        // Hago la actualizacion de los datos buscando por id
        Empleado::where('id','=',$id)->update($datosEmpleado);
        // Aqui vuelvo a buscar los datos para devolver la vista edit con los datos actualizados
        $empleado = Empleado::findOrFail($id);
        // return view('empleado.edit', compact('empleado'));

        return redirect('empleado')->with('mensaje', 'Empleado editado.');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Busco el empleado
        $empleado = Empleado::findOrFail($id);

        // Si tiene foto borro la foto de la carpeta public
        if(Storage::delete('public/'.$empleado->foto)){
            Empleado::destroy($id);
        }
        // De lo contrario boro la info del empleado
        Empleado::destroy($id);
        return redirect('empleado')->with('mensaje', 'Empleado eliminado con exito');
    }
}
