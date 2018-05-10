<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use \Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

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
            $this->validate($request, [
                'PrimerNombre'=> 'required',
                'PrimerApellido' => 'required',
                'DUI' => 'required',
                'Correo' => 'required|email|unique:clientes,correo',
                'Telefono' => 'required',
                'Clave' => 'required',
            ]);

            if($request->hasFile('Imagen')){
                $file = $request->file('Imagen');
                $extension = $file->getClientOriginalExtension();
                if($extension == 'png' || $extension == 'PNG' || $extension == 'jpg' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'JPEG' ){
                    $file_name = $request->PrimerNombre.$request->PrimerApellido.$file->getClientOriginalName();
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

                    $cliente = Cliente::where(['Correo'=>$request->Correo])->first();
                    
                    Session::put('correo',$request->correo);
                    Session::put('id',$cliente->id);

                    $success = "Bienvenido";
                    return redirect('perfil')->with('success',$success);
                }else{
                    $prb = "La imagen es obligatoria";
                    return redirect()->route('Cliente.create')->with('prb',$prb);
                }
            }else{
                $prb = "La imagen es obligatoria";
                return redirect()->route('Cliente.create')->with('prb',$prb);
            }
        }catch(QueryException $ex){
            $prb = "Ocurrio un problema inesperado vuelva a intentarlo luego";
            return redirect()->route('Cliente.create')->with('prb',$prb);
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
        if(Session::has('id')){
            if(Session::get('id') == $id){
                $cliente = Cliente::find($id);
                return View('Cliente.edit',compact('cliente'));
            }
        }else{
            $prb = "Necesita loguearse para acceder";
            return redirect('/')->with('prb',$prb);
        }
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
        if(Session::has('id')){
            if(Session::get('id') == $id){
                $this->validate($request, [
                    'PrimerNombre'=> 'required',
                    'PrimerApellido' => 'required',
                    'Telefono' => 'required',
                ]);

                $cliente = Cliente::find($id);
                $cliente->update([
                    'PrimerNombre' => $request->PrimerNombre,
                    'SegundoNombre' => $request->SegundoNombre,
                    'PrimerApellido' => $request->PrimerApellido,
                    'SegundoApellido' => $request->SegundoApellido,
                    'Telefono' => $request->Telefono,
                ]);
                $success = "Registro modificado correctamente";
                return redirect('../../perfil')->with('success',$success);
            }else{
                $prb = "Inconcordancia con el cliente a modificar";
                return redirect('../../perfil')->with('prb',$prb);
            }
        }else{
            $prb = "Necesita loguearse para acceder";
            return redirect('/')->with('prb',$prb);
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

    public function login(Request $request){
        try{
            $cliente = Cliente::where(['correo'=>$request->mail])->get();
            foreach ($cliente as $cl) {
                $pass = Crypt::decrypt($cl->clave);
                $id = $cl->id;
            }
            if(!empty($pass)){
                if($pass == $request->clave){
                    Session::put('correo',$request->correo);
                    Session::put('id',$id);
                    return redirect('perfil');
                }else{
                    $prb = "Correo o clave incorrecta";
                    return redirect('/')->with('prb',$prb);
                }
            }else{
                $prb = "No se encontro ninguna cuenta con ese correo";
                return redirect('/')->with('prb',$prb);
            }
        }catch(QueryException $ex){
            $prb = "Correo o clave incorrecta";
            return redirect('/')->with('prb',$prb);
        }
    }

    public function perfil()
    {
        $cliente = Cliente::find(Session::get('id'));
        return view('Cliente.perfil', compact('cliente'));
    }

    public function logout(){
        Session::flush();
        $success = "Vuelva pronto";
        return redirect('/');
    }

    public function clave(Request $request){
        $cliente = Cliente::find(Session::get('id'));
        $pass = Crypt::encrypt($request->Clave);
        if($request->Clave == $request->Confirm){
            $cliente->update([
                'clave' => $pass,
            ]);
            $success = "Clave cambiada correctamente";
            return redirect('../../perfil')->with('success',$success);
        }else{
            $prb = "La clave y la confirmacion no coinciden";
            return redirect('../../perfil')->with('prb',$prb);
        }
    }

    public function imagen(Request $request){
        try{
            if($request->hasFile('files')){
                $cliente = Cliente::find(Session::get('id'));
                $file = $request->file('files');
                $extension = $file->getClientOriginalExtension();
                if($extension == 'png' || $extension == 'PNG' || $extension == 'jpg' || $extension == 'JPG' || $extension == 'jpeg' || $extension == 'JPEG' ){
                    if(\File::exists(public_path('img/Clientes/'.$cliente->imagen))){
                        \File::delete(public_path('img/Clientes/'.$cliente->imagen));
                            $file_name = $cliente->PrimerNombre.$cliente->PrimerApellido.$file->getClientOriginalName();

                            Image::make($file)->resize(200,200)->save('img/Clientes/'.$file_name);
                            $cliente->update([
                                'Imagen'=>$file_name,
                            ]);
                            $success = "Imagen de perfil cambiada correctamente";
                            return redirect('../../perfil')->with('success',$success);
                    }else{
                        $prb = "No se encontro la imagen antigua";
                        return redirect('../../perfil')->with('prb',$prb);
                    }
                }else{
                    $prb = "La imagen es obligatoria";
                    return redirect('../../perfil')->with('prb',$prb);
                }
            }else{
                $prb = "No se encontro la imagen de actualizacion";
                return redirect('../../perfil')->with('prb',$prb);    
            }
        }catch(QueryException $ex){
            $prb = "Ocurrio un problema inesperado";
            return redirect('../../perfil')->with('prb',$prb);
        }
    }

    public function ajax(Request $request){
        $cliente = CLiente::where('correo',$request->correo)->first();
        return response()->json($cliente->mascotas);
    }

    public function verificarClave(Request $request){
        $id = Session::get('id');
        $cliente = Cliente::find($id);
        $pass = Crypt::decrypt($cliente->clave);
        if($pass == $request->clave){
            return 'OK';
        }
        return 'NO';
    }
}
