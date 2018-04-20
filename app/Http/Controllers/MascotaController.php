<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Mascota;
use App\Cliente;
use App\TipoMascota;

class MascotaController extends Controller
{
    public function __construct(){
        $this->middleware('login');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cliente = Cliente::find(Session::get('id'));
        $mascotas = Mascota::where(['cliente_id'=>Session::get('id')])->get();
        return view('Mascota.index', compact('mascotas','cliente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = TipoMascota::all();
        $cliente = Cliente::find(Session::get('id'));
        return view('Mascota.create', compact('cliente','tipos'));
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
            if($request->hasFile('Imagen')){
                $file = $request->file('Imagen');
                $file_name = Session::get('id').$file->getClientOriginalName();
                Image::make($file)->resize(200,200)->save('img/Mascotas/'.$file_name);
                Mascota::create([
                    'NombreMascota' => $request->Nombre,
                    'FechaNacimiento' => $request->Fecha,
                    'Imagen' => $file_name,
                    'tipo_id' => $request->Tipo,
                    'cliente_id' => Session::get('id'),
                ]);
                $success = "Mascota ingresada correctamente";
                return redirect('../../perfil')->with('success',$success);
            }else{
                $prb = "La imagen es obligatoria";
                return redirect()->route('Mascota.create')->with('prb',$prb);
            }
        }catch(QueryException $ex){
            $prb = "Ocurrio un problema inesperado, intentelo nuevamente";
            return redirect()->route('Mascota.create')->with('prb',$prb);
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
