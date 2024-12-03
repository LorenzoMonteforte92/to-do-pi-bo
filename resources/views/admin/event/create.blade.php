@extends('layouts.admin')

@section('title') {{'Crea Evento'}} 
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
<h2>Crea un nuovo evento</h2>
</div>

<form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
@csrf 


<div class="mb-4">
    <label for="name" class="form-label"><strong>Nome evento*</strong></label>
    <input class="form-control @error('name') is-invalid @enderror " type="text" id="name" name="name" value="{{ old('name') }}"></input>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


<div class="mb-4">
  <label for="img" class="form-label"><strong>Locandina</strong></label>
  <input class="form-control @error('img') is-invalid @enderror " type="file" id="img" name="img" value="{{ old('img') }}">
  @error('img')
      <div class="invalid-feedback">{{$message}}</div>
  @enderror
</div>

<div class="mb-4 d-flex justify-content-around">
    <div>
        <label for="date" class="form-label"><strong>Data *</strong></label>
        <input class="form-control @error('date') is-invalid @enderror " type="date" id="date" name="date" value="{{ old('date') }}"></input>
        @error('date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div>
        <label for="time" class="form-label"><strong>Orario *</strong></label>
        <input class="form-control @error('date') is-invalid @enderror " type="time" id="time" name="time" value="{{ old('time') }}"></input>
        @error('time')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
  
    <div>
        <label for="reservation_required" class="form-label"><strong>Prenotazione *</strong></label>
        <select class="form-select" aria-label="Default select example" id="reservation_required" name="reservation_required" >
            <option value="">Scegli un'opzione</option>
            <option value="0" {{ old('reservation_required') == '0' ? 'selected' : '' }} >Obbligatoria</option>
            <option value="1" {{ old('reservation_required') == '1' ? 'selected' : '' }} >Non necessaria</option>
        </select>
    </div>

    <div>
        <label for="cost" class="form-label"><strong>Costo dell'evento</strong></label>
        <input class="form-control @error('date') is-invalid @enderror " type="number"  min="0" step="0.01"  id="cost" name="cost" value="{{ old('cost') }}"></input>
        @error('cost')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
  </div>

<div class="mb-4">
    <label for="description" class="form-label brand-text-color-1"><strong>Descrizione</strong></label>
    <textarea class="form-control @error ('description') is-invalid @enderror " rows="8" id="description" name="description">{{ old('description') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>

<div class="mb-4 map-container d-flex flex-column">
    <label for="addressInput" class="form-label"><strong>Inserisci la location</strong></label>

    <div class="mb-4" >
        <input id="addressInput" class="form-control" type="text" placeholder="Inserisci il nome della via e il civico">
        <span><button type="button" id="address-search" class="btn btn-secondary mt-2">Clicca per cercare l'indirizzo</button></span>
    </div>

    <!-- Mappa -->
    <div id="map" class="rounded align-self-center"></div>

    <!-- Campi nascosti per latitudine e longitudine -->
    <input type="hidden" name="latitude" id="latitude">
    <input type="hidden" name="longitude" id="longitude">
</div>
  
<button type="submit" class="btn btn-primary mt-3">Salva</button>
</form>


@endsection