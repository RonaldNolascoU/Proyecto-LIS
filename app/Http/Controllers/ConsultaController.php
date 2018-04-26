<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consulta;
use App\Cliente;
use App\User;
use Illuminate\Support\Facades\Auth;

class ConsultaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($user->hasRole('Veterinario')){
            
        }elseif($user->hasRole('Secretaria')){

        }else{
            abort(401, 'Esta acción no está autorizada.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->authorizeRoles('Secretaria');
        $users = User::all();
        $vets = [];
        foreach ($users as $user) {
            if($user->hasRole('Veterinario')){
                array_push($vets,$user);
            }
        }
        return view('Consulta.create', compact('vets'));                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->authorizeRoles('Secretaria');
        try{
            $dia = date('Y-m-d');
            $hora = date('H:i:s');
            Consulta::create([
                'FechaConsulta' => $dia,
                'HoraLlegada' => $hora,
                'Peso' => $request->Peso,
                'Altura' => $request->Altura,
                'mascota_id' => $request->Mascota,
                'user_id' => $request->Veterinario,
                'Estado' => 1,
            ]);
            $success = "Registro ingresado correctamente";
            return redirect()->route('Consulta.create')->with('success',$success);
        }catch(QueryException $ex){
            $prb = "Ocurrio un problema inesperado";
            return redirect()->route('Consulta.create')->with('prb',$prb);
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
