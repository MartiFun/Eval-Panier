@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              @if(session()->has('error'))
                <div class="notification is-success">
                  {{ session('error') }}
                </div>
              @endif
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (auth()->user()->is_admin == 1)
                      <li><a class="button is-info" href="{{ route('plats.create') }}">Créer un Plat</a></li>
                      <li><a class="button is-info" href="{{ route('plats.index') }}">carte des plats</a></li>
                    @else
                      <li><a class="button is-info" href="{{ route('plats.index') }}">carte des plats</a></li>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
