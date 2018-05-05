<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
use App\TipoMedicamento;

class TipoMedicamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = TipoMedicamento::all();
        return view('User.listaTipoMedicamento', compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('User.createTipoMedicamento');
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
            TipoMedicamento::create([
                'TipoMedicamento' => $request->Nombre,
                'Estado'=> 1,
            ]);

            $success = "Tipo de medicamento ingresado exitosamente";
            return redirect()->route('TipoMedicamento.index')->with('success',$success);

        }catch(QueryException $ex){
            $prb = "Nombre de tipo ya implementado";
            return redirect()->route('TipoMedicamento.create')->with('prb',$prb);
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
        try{
            $tipo = TipoMedicamento::find($id);

            $tipo->update([
                'Estado' => 2,
            ]);

            $success = "Tipo de medicamento eliminado exitosamente";
            return redirect()->route('TipoMedicamento.index')->with('success',$success);
        }catch(Exception $ex){
            $prb = "Ocurrio un problema inesperado";
            return redirect()->route('TipoMedicamento.index')->with('prb',$prb);
        }
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
