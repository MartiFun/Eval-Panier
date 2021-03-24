@extends('layouts.app')

@section('content')
  @if(session()->has('info'))
    <div class="notification is-success">
      {{ session('info') }}
    </div>
  @endif
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Création d'un plat</p>
        </header>
        <div class="card-content">
            <div class="content">
                <form action="{{ route('plats.store') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label class="label">Nom</label>
                        <div class="control">
                          <input class="input @error('nom') is-danger @enderror" type="text" name="nom" value="{{ old('nom') }}" placeholder="nom du plat">
                        </div>
                        @error('nom')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                       <label class="label">Types</label>
                       <div class="select">
                           <select name="type_id">
                               @foreach($types as $type)
                                   <option value="{{ $type->id }}">{{ $type->nom }}</option>
                               @endforeach
                           </select>
                       </div>
                   </div>
                   <div class="field">
                      <label class="label">Vegetariens</label>
                      <div class="select">
                          <select name="vegetarien_id">
                              @foreach($vegetariens as $vegetarien)
                                  <option value="{{ $vegetarien->id }}">{{ $vegetarien->nom }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                  <div class="field">
                      <label class="label">Origine</label>
                      <div class="control">
                        <input class="input @error('origine') is-danger @enderror" type="text" name="origine" value="{{ old('origine') }}" placeholder="origine du plat">
                      </div>
                      @error('origine')
                          <p class="help is-danger">{{ $message }}</p>
                      @enderror
                  </div>
                    <div class="field">
                        <label class="label">prix</label>
                        <div class="control">
                          <input class="input" type="number" name="prix" value="{{ old('prix') }}" min="0" max="500">
                        </div>
                        @error('prix')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label class="label">poid</label>
                        <div class="control">
                          <input class="input" type="number" name="poid" value="{{ old('poid') }}" min="0" max="5000">
                        </div>
                        @error('poid')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                      <label class="label">Ingredients</label>
                      <div class="select is-multiple">
                          <select name="ingrs[]" multiple>
                              @foreach($ingredients as $ingredient)
                                  <option value="{{ $ingredient->id }}" {{ in_array($ingredient->id, old('ingrs') ?: []) ? 'selected' : '' }}>{{ $ingredient->nom }}</option>
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
