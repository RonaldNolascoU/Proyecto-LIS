<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use \Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;
use App\Mascota;
use App\Cliente;
use App\TipoMascota;
use App\Consulta;

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
        return view('Mascota.index', compact('cliente'));
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
                Image::make($file)->resize(300,300)->save('img/Mascotas/'.$file_name);
                Mascota::create([
                    'NombreMascota' => $request->Nombre,
                    'FechaNacimiento' => $request->Fecha,
                    'Imagen' => $file_name,
                    'tipo_id' => $request->Tipo,
                    'cliente_id' => Session::get('id'),
                ]);
                $success = "Mascota ingresada correctamente";
                return redirect()->route('Mascota.index')->with('success',$success);
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
        $mascota = Mascota::find($id);
        $cliente = Cliente::find(Session::get('id'));
        return view('Mascota.show', compact('cliente','mascota'));
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
            Mascota::find($id)->delete();
            $success = "Mascota eliminada correctamente";
            return redirect()->route('Mascota.index')->with('success',$success);
        }catch(QueryException $ex){
            $prb = "Ocurrio un problema inesperado, intentelo nuevamente";
            return redirect()->route('Mascota.create')->with('prb',$prb);
        }
    }

    public function imagen(Request $request){
        try{
            if($request->hasFile('files')){
                $mascota = Mascota::find($request->id);
                if(\File::exists(public_path('img/Mascotas/'.$mascota->imagen))){
                    \File::delete(public_path('img/Mascotas/'.$mascota->imagen));
                    $file = $request->file('files');
                    $file_name = Session::get('id').$file->getClientOriginalName();
                    Image::make($file)->resize(300,300)->save('img/Mascotas/'.$file_name);
                    $mascota->update([
                        'Imagen'=>$file_name,
                    ]);
                    $success = "Imagen de mascota cambiada correctamente";
                    return redirect()->route('Mascota.show',$request->id)->with('success',$success);
                  }else{
                    $prb = "Ocurrio un problema inesperado";
                    return redirect()->route('Mascota.show',$request->id)->with('prb',$prb);
                  }
            }else{
                $prb = "No se encontro la imagen de actualizacion";
                return redirect()->route('Mascota.show',$request->id)->with('prb',$prb);    
            }
        }catch(QueryException $ex){
            $prb = "Ocurrio un problema inesperado";
            return redirect()->route('Mascota.show',$request->id)->with('prb',$prb);
        }
    }

    public function listaConsultas(){
        $cliente = Cliente::find(Session::get('id'));
        return view('Mascota.consultas', compact('cliente'));
    }

    public function pdf($id){
        $consulta = Consulta::find($id);
        $pdf = PDF::loadView('Consulta.pdf', compact('consulta'));
        $nombre = 'Factura_consulta'.$id.'.pdf';
        return $pdf->download($nombre);
    }
}
