<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
use App\Diagnostico;
use App\Medicamento;

class DiagnosticoController extends Controller
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
            $diagnostico = $request->diagnostico;
            if(trim($diagnostico) != ""){
                Diagnostico::create([
                    'DescripcionDiagnostico' => $request->diagnostico,
                    'consulta_id' => $request->id,
                ]);
                return 'OK';
            }else{
                return 'NO';
            }
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
            $diagnostico = Diagnostico::find($id);
            $diagnostico->delete();
            return 'OK';
        }catch(QueryException $ex){
            return 'NO';
        }
    }

    public function llenarDiagnostico(Request $request){
        $listaMedicamentos = [];
        $listaDiagnosticos = Diagnostico::where(['consulta_id'=>$request->id])->get();
        foreach($listaDiagnosticos as $diagnostico){
            $medicamentos = Medicamento::where(['diagnostico_id'=>$diagnostico->id])->get();
            array_push($listaMedicamentos,$medicamentos);
        }
        $diagnosticos =['Diagnosticos'=>$listaDiagnosticos, 'Medicamentos'=>$listaMedicamentos];
        return $diagnosticos;
    }
}
