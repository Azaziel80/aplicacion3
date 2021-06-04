<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['empleados'] = Empleado::paginate(5);//se pone un paginado se tomaran cinco registros
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleado.create');

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

        $campos=[
            'Nombre'=> 'required|string|max:100',
            'Apellido'=> 'required|string|max:100',
            'Direccion'=> 'required|string|max:350',
            'Email'=> 'required|email',
            //'Telefono'=> 'required|telefono',
            'Foto'=> 'required|max:10000|mimes:jpeg,png,jpg',

        ];

        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La Foto es requerida',

        ];

        $this->validate($request, $campos, $mensaje);


        $datosEmpleado = request()->except('_token');
        //restriccion fotografia si existe

        if($request->hasFile('Foto')){
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }
        Empleado::insert($datosEmpleado);

        //return response()->json($datosEmpleado);
        return redirect('empleado')->with('mensaje','Empleado agregado conexito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //editar
        $empleado=Empleado::findOrFail($id);
        return view('empleado.edit', compact('empleado'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $campos=[
            'Nombre'=> 'required|string|max:100',
            'Apellido'=> 'required|string|max:100',
            'Direccion'=> 'required|string|max:350',
            'Email'=> 'required|email',
            //'Telefono'=> 'required|telefono',
        ];

        $mensaje=['required'=>'El :attribute es requerido'];

        if($request->hasFile('Foto')){
            $campos = ['Foto'=> 'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Foto.required'=>'La Foto es requerida'];
        }

        $this->validate($request, $campos, $mensaje);


        //
        $datosEmpleado = request()->except('_token','_method');//execepcion token y metodo


        if($request->hasFile('Foto')){
            $empleado=Empleado::findOrFail($id);//recuperando la informacion
            Storage::delete('public/'.$empleado->Foto);//concatene y haga el borrado foto
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }

        Empleado::where('id','=',$id)->update($datosEmpleado);//buscamos registro  el id
        $empleado=Empleado::findOrFail($id);
        //return view('empleado.edit', compact('empleado'));//retorno con los datos ya actualizados

        return redirect('empleado')->with('mensaje','Empleado Modificado'); //mensaje de modificado

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //borrar

        $empleado=Empleado::findOrFail($id);

        if(Storage::delete('public/'.$empleado->Foto)){
            Empleado::destroy($id);
        }

        return redirect('empleado')->with('mensaje','Empleado Borrado');

    }
}
