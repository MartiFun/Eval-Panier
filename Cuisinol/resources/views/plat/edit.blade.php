@extends('layouts.app')

@section('content')
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Modification d'un plat</p>
        </header>
        <div class="card-content">
            <div class="content">
                <form action="{{ route('plats.updatePlat', $plat->id) }}" method="POST">
                    @csrf
                    <div class="field">
                        <label class="label">Nom</label>
                        <div class="control">
                          <input class="input @error('nom') is-danger @enderror" type="text" name="nom" value="{{ old('nom', $plat->nom) }}" placeholder="nom du plat">
                        </div>
                        @error('nom')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">prix</label>
                        <div class="control">
                          <input class="input" type="number" name="prix" value="{{ old('prix', $plat->prix) }}" min="0" max="500">
                        </div>
                        @error('prix')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">poid</label>
                        <div class="control">
                          <input class="input" type="number" name="poid" value="{{ old('poid', $plat->poid) }}" min="0" max="5000">
                        </div>
                        @error('poid')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                       <label class="label">Types</label>
                       <div class="select">
                           <select name="type_id">
                               @foreach($types as $type)
                                   @if ($type->id == $plat->type->id)
                                     <option selected value="{{ $type->id }}">{{ $type->nom }}</option>
                                   @else
                                     <option value="{{ $type->id }}">{{ $type->nom }}</option>
                                   @endif
                               @endforeach
                           </select>
                       </div>
                   </div>
                    <div class="field">
                       <label class="label">Vegetariens</label>
                       <div class="select">
                           <select name="vegetarien_id">
                               @foreach($vegetariens as $vegetarien)
                                 @if ($vegetarien->id == $plat->vegetarien->id)
                                   <option selected value="{{ $vegetarien->id }}">{{ $vegetarien->nom }}</option>
                                 @else
                                   <option value="{{ $vegetarien->id }}">{{ $vegetarien->nom }}</option>
                                 @endif
                               @endforeach
                           </select>
                       </div>
                   </div>
                    <div class="field">
                      <label class="label">Ingredient</label>
                      <div class="select is-multiple">
                          <select name="ingrs[]" multiple>
                              @foreach($ingredients as $ingredient)
                                  <option value="{{ $ingredient->id }}" {{ in_array($ingredient->id, old('ingrs') ?: $plat->ingredients->pluck('id')->all()) ? 'selected' : '' }}>{{ $ingredient->nom }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                    <div class="field">
                        <div class="control">
                          <button class="button is-link">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
