<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Consulta;
use App\Cliente;
use App\Mascota;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

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
        if(Auth::user()->hasRole('Veterinario')){
            
        }elseif(Auth::user()->hasRole('Secretaria')){
            $users = User::all();
            $vets = [];
            foreach ($users as $user) {
                if($user->hasRole('Veterinario')){
                    array_push($vets,$user);
                }
            }
            $consultasIngresadas = Consulta::where('Estado',1)->orderBy('HoraLlegada','asc')->get();
            $consultasTerminadas = Consulta::where('Estado',3)->orderBy('HoraLlegada','asc')->get();
            return view('Consulta.listaConsultaSecretaria', compact('consultasIngresadas','consultasTerminadas','vets'));
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
            $cuenta = Consulta::where(['mascota_id'=>$request->Mascota, 'Estado'=>1])->count();
            if($cuenta == 0){
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
                return redirect()->route('Consulta.index')->with('success',$success);
            }else{
                $prb = "Ya tiene una consulta en espera";
                return redirect()->route('Consulta.create')->with('prb',$prb);
            }
        }catch(QueryException $ex){
            $prb = "Ocurrio un problema inesperado";
            return redirect()->route('Consulta.index')->with('prb',$prb);
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
        $consulta = Consulta::find($id);
        $c = ['consulta' => [$consulta], 'mascota' => [$consulta->mascota], 'veterinario' => [$consulta->veterinario]];
        return $c;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $consulta = Consulta::find($id);
        $c = ['consulta' => [$consulta], 'mascota' => [$consulta->mascota], 'veterinario' => [$consulta->veterinario]];
        return $c;
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
            Consulta::find($id)->delete();
            $success = "Cosulta eliminada correctamente";
            return redirect()->route('Consulta.index')->with('success',$success);
        }catch(QueryException $ex){
            $prb = "Ocurrio un problema inesperado, intentelo nuevamente";
            return redirect()->route('Consulta.index')->with('prb',$prb);
        }
    }

    public function llenarEntrantes(){
        $consultasIngresadas = Consulta::where('Estado',1)->get();
        return $consultasIngresadas;
    }

    public function conseguirMascota(Request $request){
        $mascota = Mascota::find($request->id);
        return $mascota;
    }

    public function conseguirVeterinario(Request $request){
        $vet = User::find($request->id);
        return $vet;
    }

    public function pasar(Request $request){
        try{
            $consulta = Consulta::find($request->id);
            $cuenta = Consulta::where(['user_id'=>$consulta->user_id,'Estado'=>2])->count();
            if($cuenta == 0){
                $consulta->update([
                    'Estado' => 2,
                ]);
                $success = "Siguiente: ". $consulta->mascota->NombreMascota. " del sr/sra: ".$consulta->mascota->cliente->PrimerNombre." ".$consulta->mascota->cliente->PrimerApellido.", con el veterinario: ". $consulta->veterinario->name;
                return redirect()->route('Consulta.index')->with('success',$success);
            }else{
                $prb = "El veterinario ya esta atendiendo un paciente";
                return redirect()->route('Consulta.index')->with('prb',$prb);
            }
        }catch(QueryException $ex){
            $prb = "Ocurrio un problema inesperado, intentelo nuevamente";
            return redirect()->route('Consulta.index')->with('prb',$prb);
        }
    }

    public function veterinarios(){
        $users = User::all();
        $vet = [];
        foreach ($users as $user) {
            $cuenta = Consulta::where(['user_id'=>$user->id, 'Estado'=>2])->count();
            if($cuenta == 0 AND $user->hasRole('Veterinario')){
                array_push($vet,$user);
            }
        }
        return $vet;
    }
}
