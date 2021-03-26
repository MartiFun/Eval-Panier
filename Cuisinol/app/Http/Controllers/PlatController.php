<?php

namespace App\Http\Controllers;
use App\Models\{Plat, Type, Vegetarien, Ingredient, Panier, User};

use Illuminate\Http\Request;
use App\Http\Requests\Plat as PlatRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlatController extends Controller
{

    //affiche les plats
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

    //affichage de la page de creation d'un plat
    public function create()
    {
      $types = Type::all();
      $vegetariens = Vegetarien::all();
      $ingredients = Ingredient::all();

      return view('plat.create', compact('types', 'vegetariens', 'ingredients'));
    }

    //store un plat
    public function store(PlatRequest $platRequest)
    {
      $plat = Plat::create($platRequest->all());
      $plat->ingredients()->attach($platRequest->ingrs);
      return redirect()->back()->with('info', 'Le plat a bien été créé');
    }

    //affiche la modif d'un plat
    public function edit(Plat $plat)
    {
      $types = Type::all();
      $vegetariens = Vegetarien::all();
      $ingredients = Ingredient::all();
      return view('plat.edit', compact('plat', 'types', 'vegetariens', 'ingredients'));
    }

    //modifie un plat
    public function updatePlat(PlatRequest $platRequest, Plat $plat)
    {
      // $plat->update($platRequest->all());
      // $plat->ingredients()->sync($platRequest->ingrs);
      // $plat->types()->sync($platRequest->type_id);
      // $plat->vegetariens()->sync($platRequest->vegetarien_id);
      // return redirect()->back()->with('info', 'Le plat a bien été modifié');
    }

    //supprime un plat
    public function destroy(Plat $plat)
    {
      $plat = Plat::all()->where("id", "=", $plat->id)->first();
      //supprime les relations du plat avec ses ingredients
      foreach ($plat->ingredients as $ingredient) {
        $plat->ingredients()->detach($ingredient->id);
      }
      $plat->delete();
      return back()->with('info', 'Le plat a bien été supprimé dans la base de données.');
    }

    //enregistre un ingredient en bdd
    public function storeIngredient(Request $request)
    {
      $request->validate([
            'ingredient'=> ['required', 'string', 'max:100'],
            ]);
      Ingredient::create(['nom' => $request->ingredient, 'slug' => Str::slug($request->ingredient)]);
      return back()->with('info', 'L\'ingredient a bien été ajouté dans la base de données.');
    }

    //enregistre un type en bdd
    public function storeType(Request $request)
    {
      $request->validate([
            'type'=> ['required', 'string', 'max:100'],
            ]);
      Type::create(['nom' => $request->type, 'slug' => Str::slug($request->type)]);
      return back()->with('info', 'Le type de plat a bien été ajouté dans la base de données.');
    }

    //enregistre un type de nouriture en bdd
    public function storeVegetarien(Request $request)
    {
      $request->validate([
            'vegetarien'=> ['required', 'string', 'max:100'],
            ]);
      Vegetarien::create(['nom' => $request->vegetarien, 'slug' => Str::slug($request->vegetarien)]);
      return back()->with('info', 'Le type de nouriture a bien été ajouté dans la base de données.');
    }
}
