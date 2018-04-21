<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Caracteristica;

class CaracteristicaController extends Controller
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
        try{
            Caracteristica::create([
                'DescripcionCaracteristica' => $request->Caracteristica,
                'mascota_id' => $request->id,
            ]);
            $success = "Caracteristica ingresada correctamente";
            return redirect()->route('Mascota.show',$request->id)->with('success',$success);   
        }catch(QueryException $ex){
            $prb = "Ocurrio un problema inesperado, intentelo nuevamente";
            return redirect()->route('Mascota.show',$request->id)->with('prb',$prb);
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
        try{
            $caracteristica = Caracteristica::find($id);
            $mascota = $caracteristica->mascota;
            $caracteristica->delete();
            $success = "Caracteristica eliminada correctamente";
            return redirect()->route('Mascota.show',$mascota)->with('success',$success);   
        }catch(QueryException $ex){
            $prb = "Ocurrio un problema inesperado, intentelo nuevamente";
            return redirect()->route('Mascota.show',$mascota)->with('prb',$prb);
        }
    }
}
