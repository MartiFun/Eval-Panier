@extends('layouts.app')

@section('content')
  @if(session()->has('info'))
    <div class="notification is-success">
      {{ session('info') }}
    </div>
  @endif
    <div class="card">
      <header class="card-header">
          <p class="card-header-title">Plats</p>
          <a class="button is-info" href="{{ route('plats.create') }}">Créer un Plat</a>
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
                        @foreach($plats as $plat)
                            <tr>
                                <td>{{ $plat->id }}</td>
                                <td><strong>{{ $plat->nom }}</strong>{{ $plat->vegetarien }}</br>Prix : {{ $plat->prix }} {{ $plat->type }} {{ $plat->poid }}</br>Origine : {{ $plat->origine }}</td>
                                <td><a class="button is-warning" href="{{ route('plats.edit', $plat->id) }}">Modifier</a></td>
                                <td>
                                    <form action="{{ route('plats.destroy', $plat->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button is-danger" type="submit">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <footer class="card-footer">
          {{ $plats->links() }}
        </footer>
    </div>
@endsection
