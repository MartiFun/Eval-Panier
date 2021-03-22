@extends('layouts.app')

@section('content')
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
                        <div class="control">
                          <button class="button is-link">Envoyer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
