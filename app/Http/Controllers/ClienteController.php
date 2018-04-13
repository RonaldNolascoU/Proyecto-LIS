<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $v = Validator::make($request->all(), [
                'PrimerNombre' => 'required',
                'SegundoNombre' => '',
                'PrimerApellido' => 'required',
                'SegundoApellido' => '',
                'DUI' => 'required',
                'Correo' => 'required|email|unique:Cliente',
                'Telefono' => 'required',
                'clave' => 'required',
                'Imagen' => 'required|Imagen',
            ]);

            if($v->fails()){
                return redirect()->back()->withInput()->withErrors($v->errors());
            }
            if($request->hasFile('Imagen')){
                $file = $request->file('Imagen');
                $extension = $file->getClientOriginalExtension();
                $file_name = $request->PrimerNombre.$request->PrimerApellido.'.'.$extension;
                Image::make($file)->resize(200,200)->save('img/Clientes/'.$file_name);
                $pass = Crypt::encrypt($request->Clave);
                Cliente::create([
                    'PrimerNombre' => $request->PrimerNombre,
                    'SegundoNombre' => $request->SegundoNombre,
                    'PrimerApellido' => $request->PrimerApellido,
                    'SegundoApellido' => $request->SegundoApellido,
                    'DUI' => $request->DUI,
                    'Correo' => $request->Correo,
                    'Telefono' => $request->Telefono,
                    'clave' => ''.$pass.'',
                    'Imagen' => $file_name,
                ]);
                $success = "Registro ingresado correctamente";
                return view('index', compact('success'));
            }else{
                dd('No imagen');
            }
        }catch(\Illuminate\Database\QueryException $ex){
            $errors = "Correo electronico ya implementado en otra cuenta";
            return view('Cliente.create', compact('errors'));
        }

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
