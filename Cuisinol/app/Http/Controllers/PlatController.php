<?php

namespace App\Http\Controllers;
use App\Models\{Plat, Type, Vegetarien, Ingredient};

use Illuminate\Http\Request;
use App\Http\Requests\Plat as PlatRequest;
use Illuminate\Support\Facades\Route;

class PlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug = null, Request $request)
    {

      $ingredients = Ingredient::all();
      $types = Type::all();
      $model = null;
      $query = Plat::query();
      $plats = null;
      if($slug || count($request->request) > 0) {
          if(Route::currentRouteName() == 'plats.ingredient') {
            $model = new Ingredient;
            $query = $model ? $model->whereSlug($slug)->firstOrFail()->plats() : Plat::query();
            $plats = $query->oldest('nom')->get();
          }
          else if (Route::currentRouteName() == 'plats.type') {
            $model = new Type;
            $query = $model ? $model->whereSlug($slug)->firstOrFail()->plats() : Plat::query();
            $plats = $query->oldest('nom')->get();
          }
          else if ($request->input('nom') != null){
            $plats = $query->where('nom', 'like', '%'.$request->nom.'%')->oldest('nom')->get();
          }
          else if ($request->input('prixmin') != null || $request->input('prixmax') != null){
            if ($request->input('prixmin') == null) {
              $plats = $query->where('prix', '<', intval($request->input('prixmax')))->oldest('nom')->get();
            }elseif ($request->input('prixmax') == null) {
              $plats = $query->where('prix', '>', intval($request->input('prixmin')))->oldest('nom')->get();
            }else {
              $plats = $query->where('prix', '>', intval($request->input('prixmin')))
                             ->where('prix', '<', intval($request->input('prixmax')))->oldest('nom')->get();
            }
          }
          else {
            $plats = $query->oldest('nom')->get();
          }
      }else{
        $plats = $query->oldest('nom')->get();
      }

      //dd($plats);
      if (auth()->user()->is_admin == 1) {
        return view('plat.index', compact('plats', 'ingredients', 'slug', 'types'));
      }
      else {
        return view('plat.indexUser', compact('plats', 'ingredients', 'slug', 'types'));
      }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $types = Type::all();
      $vegetariens = Vegetarien::all();
      $ingredients = Ingredient::all();

      return view('plat.create', compact('types', 'vegetariens', 'ingredients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlatRequest $platRequest)
    {
      $plat = Plat::create($platRequest->all());
      $plat->ingredients()->attach($platRequest->ingrs);
      return redirect()->back()->with('info', 'Le plat a bien été créé');
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
      $types = Type::all();
      $vegetariens = Vegetarien::all();
      $ingredients = Ingredient::all();
      return view('plat.edit', compact('plat', 'types', 'vegetariens', 'ingredients'));
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
      $plat->ingredients()->sync($platRequest->ingrs);
      $plat->types()->sync($platRequest->type_id);
      $plat->vegetariens()->sync($platRequest->vegetarien_id);
      return redirect()->back()->with('info', 'Le plat a bien été modifié');
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
