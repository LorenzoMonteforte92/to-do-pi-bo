@extends('layouts.admin')
@section('title') {{'Modifica Profilo'}} 
@endsection

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="mb-5" >
  <h2 class="mb-3" >Ciao {{ $user->name }}</h2>
  <h5>Modifica da qui i dati della tua attività</h5>
</div>

<form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
    @csrf 

    
    <div class="mb-4">
        <label for="name" class="form-label"><strong>Nome della tua realtà *</strong></label>
        <input class="form-control @error('name') is-invalid @enderror " type="text" id="name" name="name" value="{{ old('name', $newProfile->name) }}"></input>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    <div class="mb-4" >
      <label class="form-label"  for="organiser_id"><strong>Che tipo di professionista sei?</strong></label>
    <select class="form-select" aria-label="Default select example" id="organiser_id" name="organiser_id" >
        <option value="">Seleziona l'opzione che più ti rappresenta</option>
        @foreach ($organiser as $singleOrganiser)
            <option @selected($newProfile->organisers->contains($singleOrganiser)) value="{{ $singleOrganiser->id }}">{{ Str::ucfirst($singleOrganiser->name) }}</option>
        @endforeach
    </select>
    </div>

    <div class="mb-4">
      <label for="img" class="form-label"><strong>Modifica il tuo logo personale</strong></label>
      <input class="form-control @error('img') is-invalid @enderror " type="file" id="img" name="img" value="{{ old('img') }}">
      @error('img')
          <div class="invalid-feedback">{{$message}}</div>
      @enderror
  </div>

  <div class="mb-4">
      <label for="phone_num" class="form-label"><strong>Modifica numero di telefono</strong></label>
      <input class="form-control @error('phone_num') is-invalid @enderror " type="text" id="phone_num" name="phone_num" value="{{ old('phone_num', $newProfile->phone_num) }}"></input>
      @error('phone_num')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
  </div>

  <div class="mb-4 map-container d-flex flex-column">
    <label for="addressInput" class="form-label"><strong>Modifica indirizzo</strong></label>

    <div>
        <input id="addressInput" class="form-control" type="text" placeholder="Inserisci via, civico e città">
        <span><button type="button" id="address-search" class="btn btn-secondary mt-2">Cerca indirizzo</button></span>
    </div>

    <!-- Mappa -->
    <div id="map" class="rounded align-self-center" data-route={{Route::currentRouteName()}} data-latitude={{$newProfile->latitude}} data-longitude={{$newProfile->longitude}} data-name={{$newProfile->name}}></div>

    <!-- Campi nascosti per latitudine e longitudine -->
    <input type="hidden" name="latitude" id="latitude">
    <input type="hidden" name="longitude" id="longitude">
</div>
    

  <div class="mb-4">
    <label for="bio" class="form-label brand-text-color-1"><strong>Racconta qualcosa riguardo la tua attività</strong></label>
    <textarea class="form-control @error ('bio') is-invalid @enderror " rows="8" id="bio" name="bio">{{ old('bio', $newProfile->bio) }}</textarea>
    @error('bio')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
      
    <button type="submit" class="btn btn-primary mt-3">Salva</button>
</form>

@endsection
