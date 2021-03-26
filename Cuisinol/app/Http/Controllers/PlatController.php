<?php

namespace App\Http\Controllers;
use App\Models\{Plat, Type, Vegetarien, Ingredient, Panier, User};

use Illuminate\Http\Request;
use App\Http\Requests\Plat as PlatRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class PlatController extends Controller
{

    public function index($slug = null, Request $request)
    {
      //recupere les données utiles
      $ingredients = Ingredient::all();
      $types = Type::all();
      $model = null;
      $query = Plat::query();
      $plats = null;

      //si l'url a un slug ou un parametre
      if($slug || count($request->request) > 0) {
          //si le slug est ingredient alors : cherche les plats avec cet ingredient
          if(Route::currentRouteName() == 'plats.ingredient') {
            $model = new Ingredient;
            $query = $model ? $model->whereSlug($slug)->firstOrFail()->plats() : Plat::query();
            $plats = $query->oldest('nom')->get();
          }
          //si le slug est type alors : cherche les plats avec ce type
          else if (Route::currentRouteName() == 'plats.type') {
            $model = new Type;
            $query = $model ? $model->whereSlug($slug)->firstOrFail()->plats() : Plat::query();
            $plats = $query->oldest('nom')->get();
          }
          //si il y a un parametre nom alors : cherche les plats avec ce nom
          else if ($request->input('nom') != null){
            $plats = $query->where('nom', 'like', '%'.$request->nom.'%')->oldest('nom')->get();
          }
          //si il y a un parametre priw minimum ou prix maximum alors :
          else if ($request->input('prixmin') != null || $request->input('prixmax') != null){
            //si que prix max est rempli alors utilisé que <
            if ($request->input('prixmin') == null) {
              $plats = $query->where('prix', '<', intval($request->input('prixmax')))->oldest('nom')->get();
            }
            //si que prix min est rempli alors utilisé que >
            elseif ($request->input('prixmax') == null) {
              $plats = $query->where('prix', '>', intval($request->input('prixmin')))->oldest('nom')->get();
            }
            //si les deux sont rempli alors utilisé < et >
            else {
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

      //verifie si l'utilisateur est admin
      if (auth()->user()->is_admin == 1) {
        return view('plat.index', compact('plats', 'ingredients', 'slug', 'types'));
      }
      else {
        return view('plat.indexUser', compact('plats', 'ingredients', 'slug', 'types'));
      }

    }


    public function create()
    {
      $types = Type::all();
      $vegetariens = Vegetarien::all();
      $ingredients = Ingredient::all();

      return view('plat.create', compact('types', 'vegetariens', 'ingredients'));
    }


    public function store(PlatRequest $platRequest)
    {
      $plat = Plat::create($platRequest->all());
      $plat->ingredients()->attach($platRequest->ingrs);
      return redirect()->back()->with('info', 'Le plat a bien été créé');
    }


    public function show(Plat $plat)
    {
      $query = User::query()->where('id', '=', ''.auth()->user()->id.'');
      $users = $query->with('plats')->get();
      $exist = false;

      foreach ($users[0]->plats as $platEx) {
        if ($platEx->id == $plat->id) {
          $platExQ = DB::table('plat_user')->where("plat_id", "=", $plat->id)->first();
          // dd($platExQ->quantite);
          $exist = true;
          $plat->users()->updateExistingPivot(auth()->user()->id , ['quantite' => intval($platExQ->quantite)+1]);
        }
      }
      if ($exist === false) {
        $plat->users()->attach(auth()->user()->id, ['quantite' => '1']);
      }

      return redirect()->back()->with('info', 'Le plat a bien été ajouté au panier');
    }

    public function updatePanier(Plat $plat)
    {
      $plat = Plat::all()->where("id", "=", array_keys(request()->all())[2])->first();
      $plat->users()->updateExistingPivot(auth()->user()->id , ['quantite' => intval(request()->quantite)]);
      return redirect()->back()->with('info', 'Le plat a bien été ajouté au panier');
    }


    public function showPanier()
    {
      $query = User::query()->where('id', '=', ''.auth()->user()->id.'');
      $users = $query->with('plats')->get();
      return view('plat.panier', compact('users'));
    }

    public function destroyPanier(Plat $plat)
    {
      $plat = Plat::all()->where("id", "=", array_keys(request()->all())[2])->first();
      $plat->users()->detach(auth()->user()->id);
      return back()->with('info', 'Le plat a bien été supprimé du panier.');
    }

    public function edit(Plat $plat)
    {
      $types = Type::all();
      $vegetariens = Vegetarien::all();
      $ingredients = Ingredient::all();
      return view('plat.edit', compact('plat', 'types', 'vegetariens', 'ingredients'));
    }


    public function update(PlatRequest $platRequest, Plat $plat)
    {
      // $plat->update($platRequest->all());
      // $plat->ingredients()->sync($platRequest->ingrs);
      // $plat->types()->sync($platRequest->type_id);
      // $plat->vegetariens()->sync($platRequest->vegetarien_id);
      // return redirect()->back()->with('info', 'Le plat a bien été modifié');
    }


    public function destroy(Plat $plat)
    {
      $plat->delete();
      return back()->with('info', 'Le plat a bien été supprimé dans la base de données.');
    }
}
