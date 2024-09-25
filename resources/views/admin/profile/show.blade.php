@extends('layouts.admin')
@section('title') {{'Visualizza profilo'}} 
@endsection

@section('content')
    @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
    @endif
    
 
    <div class="mb-5" >
        <h2 class="mb-3" >Ciao {{ $user->name }}</h2>
        <h5>Qui puoi visualizzare il tuo profilo</h5>
    </div>

    <div class="mb-4">
        <h5>Logo</h5>
        <img src="{{ asset('storage/' . $newProfile->img) }}" alt="{{ $newProfile->name }}">
    </div>

    <div class="mb-4">
        <h5>Nome Attività</h5>
        <span>{{ $newProfile->name }}</span>
    </div>

    <div class="mb-4">
        <h5>Tipologia</h5>
        <span>{{ $newProfile->organisers[0]->name}}</span>
    </div>

    <div class="mb-4">
        <h5>Numero di telefono</h5>
        <span>{{ $newProfile->phone_num }}</span>
    </div>

    <div class="mb-4">
        <h5>Descrizione</h5>
        <span>{{ $newProfile->bio }}</span>
    </div>

@endsection