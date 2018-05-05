<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
use App\Sintoma;

class SintomaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('estado');
    }
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
            Sintoma::create([
                'DescripcionSintoma' => $request->sintoma,
                'consulta_id' => $request->id,
            ]);
            $sintomas = Sintoma::where(['consulta_id'=>$request->id])->get();
            return $sintomas;
        }catch(QueryException $ex){
            return 'Problema';
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
            $sintoma = Sintoma::find($id);
            $consulta = $sintoma->consulta_id;
            $sintoma->delete();
            $sintomas = Sintoma::where(['consulta_id'=>$consulta])->get();
            return $sintomas;
        }catch(QueryException $ex){
            return 'Problema';
        }
    }

    public function llenarSintomas(Request $request){
        $sintomas = Sintoma::where(['consulta_id'=>$request->id])->get();
        return $sintomas;
    }
}
