<?php

namespace App\Http\Controllers;
use App\Models\{Plat, Type, Vegetarien, Ingredient, Panier, User};

use Illuminate\Http\Request;
use App\Http\Requests\Plat as PlatRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class PanierController extends Controller
{

    //affiche le panier
    public function index()
    {
     $query = User::query()->where('id', '=', ''.auth()->user()->id.'');
     $users = $query->with('plats')->get();
     return view('plat.panier', compact('users'));
    }

    //ajoute un plat au panier
    public function store(Plat $plat)
    {
      $plat = Plat::all()->where("id", "=", array_keys(request()->all())[1])->first();
      $query = User::query()->where('id', '=', ''.auth()->user()->id.'');
      $users = $query->with('plats')->get();
      $exist = false;

      //verifie si le plat ajouté existe deja dans le panier de l'utilisateur
      foreach ($users[0]->plats as $platEx) {
        if ($platEx->id == $plat->id) {
          //si il existe alors juste augmenté la quantite dans le panier
          $platExQ = DB::table('plat_user')->where("plat_id", "=", $plat->id)->first();
          $exist = true;
          $plat->users()->updateExistingPivot(auth()->user()->id , ['quantite' => intval($platExQ->quantite)+1]);
        }
      }
      if ($exist === false) {
        $plat->users()->attach(auth()->user()->id, ['quantite' => '1']);
      }

      return redirect()->back()->with('info', 'Le plat a bien été ajouté au panier');
    }

    //change la quantite d'un plat
    public function updatePanier(Plat $plat)
    {
      $plat = Plat::all()->where("id", "=", array_keys(request()->all())[2])->first();
      $plat->users()->updateExistingPivot(auth()->user()->id , ['quantite' => intval(request()->quantite)]);
      return redirect()->back()->with('info', 'Le plat a bien été ajouté au panier');
    }

    //suprime un plat du panier
    public function destroyPanier(Plat $plat)
    {
     $plat = Plat::all()->where("id", "=", array_keys(request()->all())[2])->first();
     $plat->users()->detach(auth()->user()->id);
     return back()->with('info', 'Le plat a bien été supprimé du panier.');
    }
}
