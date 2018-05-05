<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
use App\Servicio;

class ServicioController extends Controller
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
            Servicio::create([
                'DescripcionServicio' => $request->servicio,
                'Precio' => $request->precio,
                'consulta_id' => $request->id,
            ]);
            return 'OK';
        }catch(QueryException $ex){
            return 'NO';
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
            Servicio::find($id)->delete();
            return 'OK';
        }catch(QueryException $ex){
            return 'NO';
        }
    }

    public function llenarServicios(Request $request){
        $servicios = Servicio::where(['consulta_id'=>$request->id])->get();
        return $servicios;
    }
}
