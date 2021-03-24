@extends('layouts.app')

@section('content')
  @if(session()->has('info'))
    <div class="notification is-success">
      {{ session('info') }}
    </div>
  @endif
    <div class="card">
      <header class="card-header">
          <p class="card-header-title">Panier</p>
      </header>
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
                        @foreach($users as $user)
                          @foreach ($user->plats as $plat)
                            @php
                              $platExQ = DB::table('plat_user')->where("plat_id", "=", $plat->id)->first();
                            @endphp
                              <tr>
                                <td>{{ $plat->id }}</td>
                                <td><strong>{{ $plat->nom}}</strong> {{ $plat->vegetarien->nom }}</br>Prix : {{ $plat->prix }}$  {{ $plat->type->nom }}  {{ $plat->poid }} g</br>Origine : {{ $plat->origine }}</td>
                                <td>
                                  <p>Ingredients :</p>
                                  <ul>
                                    @foreach($plat->ingredients as $ingredient)
                                      <li>{{ $ingredient->nom }}</li>
                                    @endforeach
                                  </ul>
                                </td>
                                <td>
                                  <form action="{{ route('plats.updatePanier', $plat->id) }}" method="post">
                                      @csrf
                                      <div class="control">
                                        <input class="input" type="number" name="quantite" value="{{$platExQ->quantite}}" min="0" max="5000">
                                      </div>
                                      <button class="button is-danger" type="submit">modifier</button>
                                  </form>
                                </td>
                                <td>
                                    <form action="{{ route('plats.destroyPanier', $plat) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button is-danger" type="submit">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                          @endforeach
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
