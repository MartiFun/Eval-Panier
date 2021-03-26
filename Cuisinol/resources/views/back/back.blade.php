@extends('layouts.app')

@section('content')
  @if(session()->has('info'))
    <div class="notification is-success">
      {{ session('info') }}
    </div>
  @endif
    <div class="card">
        <header class="card-header">
            <p class="card-header-title">Création</p>
        </header>
        <div class="card-content">
            <div class="content">
                <form action="{{ route('plats.storeIngredient') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label class="label">Ingredient</label>
                        <div class="control">
                          <input class="input @error('ingredient') is-danger @enderror" type="text" name="ingredient" value="{{ old('ingredient') }}" placeholder="nom de l'ingredient">
                        </div>
                        @error('ingredient')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <div class="control">
                          <button class="button is-link">Envoyer</button>
                        </div>
                    </div>
                </form>
              </br>
                <form action="{{ route('plats.storeType') }}" method="POST">
                    @csrf
                    <div class="field">
                        <label class="label">Type</label>
                        <div class="control">
                          <input class="input @error('type') is-danger @enderror" type="text" name="type" value="{{ old('type') }}" placeholder="nom du type de plat">
                        </div>
                        @error('type')
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <div class="control">
                          <button class="button is-link">Envoyer</button>
                        </div>
                    </div>
                </form>
              </br>
              <form action="{{ route('plats.storeVegetarien') }}" method="POST">
                  @csrf
                  <div class="field">
                      <label class="label">Vegetarien</label>
                      <div class="control">
                        <input class="input @error('vegetarien') is-danger @enderror" type="text" name="vegetarien" value="{{ old('vegetarien') }}" placeholder="nom du type de nourtiture">
                      </div>
                      @error('vegetarien')
                          <p class="help is-danger">{{ $message }}</p>
                      @enderror
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
