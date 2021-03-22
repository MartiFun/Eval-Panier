<?php

namespace App\Http\Controllers;
use App\Models\Plat;

use Illuminate\Http\Request;
use App\Http\Requests\Plat as PlatRequest;

class PlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $plats = Plat::paginate(5);
      return view('plat.index', compact('plats'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('plat.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlatRequest $platRequest)
    {
      Plat::create($platRequest->all());
      return redirect()->route('plat.index')->with('info', 'Le plat a bien été créé');
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
    public function edit(Plat $plat)
    {
      return view('plat.edit', compact('plat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlatRequest $platRequest, Plat $plat)
    {
      $plat->update($platRequest->all());
      return redirect()->route('plats.index')->with('info', 'Le plat a bien été modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plat $plat)
    {
      $plat->delete();
      return back()->with('info', 'Le plat a bien été supprimé dans la base de données.');

    }
}
