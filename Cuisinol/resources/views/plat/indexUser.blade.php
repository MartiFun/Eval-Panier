@extends('layouts.app')

@section('content')
@if(session()->has('info'))
    <div class="notification is-success">
        {{ session('info') }}
    </div>
    @endif
    <div class="card">
        <div class="header">
            <h2 class="card-header-title">Plats</h2>
            <div class="field">
                <div class="selects">
                    <div class="select">
                        <select onchange="window.location.href = this.value">
                            <option value="{{ route('plats.index') }}" @unless($slug) selected @endunless>Toutes ingredients</option>
                                @foreach($ingredients as $ingredient)
                                <option value="{{ route('plats.ingredient', $ingredient->slug) }}" {{ $slug == $ingredient->slug ? 'selected' : '' }}>{{ $ingredient->nom }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="select">
                        <select onchange="window.location.href = this.value">
                            <option value="{{ route('plats.index') }}" @unless($slug) selected @endunless>Toutes types</option>
                                @foreach($types as $type)
                                <option value="{{ route('plats.type', $type->slug) }}" {{ $slug == $type->slug ? 'selected' : '' }}>{{ $type->nom }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>

                <form class="research" action="{{ route('plats.nom') }}" method="GET">
                    @csrf
                    <input class="input" type="text" name="nom" value="" placeholder="rechercher un plat">
                    <button class="button is-info" type="submit">chercher</button>
                </form>

                <form class="price" action="{{ route('plats.prix') }}" method="GET">
                    @csrf
                    <label for="prixmin">prix minimum</label>
                    <input class="input" min="0" max="5000" type="number" name="prixmin" value="">
                    <label for="prixmax">prix maximal</label>
                    <input class="input" min="0" max="5000" type="number" name="prixmax" value="">
                    <button class="button is-info" type="submit">chercher</button>
                </form>

            </div>
        </div>



        <div class="card-content">
            <div class="content">
                <table class="table is-hoverable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Plats</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($plats as $plat)
                        <tr>
                            @php
                            // $plat->with('ingredients')->get();
                            @endphp
                            <td>{{ $plat->id }}</td>
                            <td><strong>{{ $plat->nom}}</strong> {{ $plat->vegetarien->nom }}</br>Prix : {{ $plat->prix }}$ {{ $plat->type->nom }} {{ $plat->poid }} g</br>Origine : {{ $plat->origine }}</td>
                            <td>
                                <p>Ingredients :</p>
                                <ul>
                                    @foreach($plat->ingredients as $ingredient)
                                        <li>{{ $ingredient->nom }}</li>
                                        @endforeach
                                </ul>
                            </td>
                            <td>
                                <form action="{{ route('paniers.store', $plat->id) }}" method="POST">
                                    @csrf
                                    <button class="button is-danger" type="submit">ajouter au panier</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <footer class="card-footer">
          {{ $plats->links() }}
        </footer> --}}
    </div>
    @endsection
