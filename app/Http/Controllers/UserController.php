<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;
use App\Mail\SendPassword;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Role;

class UserController extends Controller
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
        $users = User::all();
        return view('User.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::All();
        return view('User.create', compact('roles'));
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

            $password = str_random(8);
            $user = User::create([
                'name'=>$request->Nombre,
                'email'=>$request->Correo,
                'estado'=>1,
                'password'=>bcrypt($password),
            ]);
            $user->roles()->attach(Role::find($request->Tipo));

            Mail::to($request->Correo)->send(new SendPassword($user));

            $success = "Usuario ingresado exitosamente";
            return redirect()->route('User.index')->with('success',$success);

        }catch(QueryException $ex){
            $prb = "Correo electronico ya implementado";
            return redirect()->route('User.create')->with('prb',$prb);
        }catch(\Exception $ex){
            dd($ex);
            $prb = "Problema enviando el correo, verifique que este bien escrito";
            return redirect()->route('User.create')->with('prb',$prb);
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
            $user = User::find($id);

            $user->update([
                'estado' => 2,
            ]);

            $success = "Usuario degradado exitosamente";
            return redirect()->route('User.index')->with('success',$success);
        }catch(Exception $ex){
            $prb = "Ocurrio un problema inesperado";
            return redirect()->route('User.index')->with('prb',$prb);
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
