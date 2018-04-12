<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Input;

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
        $this->validate($request,['PrimerNombre'=>'required','SegundoNombre','PrimerApellido'=>'required','SegundoApellido','DUI'=>'required','Imagen'=>'required','Correo'=>'required','Telefono'=>'required','clave'=>'required']);
        $encription = new Encryption();
        $encription->fill(['PrimerNombre'=>($request->PrimerNombre),'SegundoNombre'=>($request->PrimerNombre),'PrimerApellido'=>($request->PrimerNombre),'SegundoApellido'=>($request->PrimerNombre),'DUI'=>($request->PrimerNombre),'NIT'=>($request->PrimerNombre),'Correo'=>($request->PrimerNombre),'Telefono'=>($request->PrimerNombre),'clave'=>Crypt::encrypt($request->PrimerNombre)])-save();

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
