@extends('layouts.admin')
@section('title') {{'Crea Profilo'}} 
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
  <h2 class="mb-3" >Benvenut* {{ $user->name }}</h2>
  <h5>Crea un profilo da organizzatore da cui gestire i tuoi eventi</h5>
</div>

<form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
    @csrf 

    
    <div class="mb-4">
        <label for="name" class="form-label"><strong>Nome della tua realtà *</strong></label>
        <input class="form-control @error('name') is-invalid @enderror " type="text" id="name" name="name" value="{{ old('name') }}"></input>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    <div class="mb-4" >
      <label class="form-label"  for="organiser_id"><strong>Che tipo di professionista sei?</strong></label>
    <select class="form-select" aria-label="Default select example" id="organiser_id" name="organiser_id" >
        <option value="">Seleziona l'opzione che più ti rappresenta</option>
        @foreach ($organiser as $singleOrganiser)
            <option @selected($singleOrganiser->id == old('organiser_id')) value="{{ $singleOrganiser->id }}">{{ Str::ucfirst($singleOrganiser->name) }}</option>
        @endforeach
    </select>
    </div>

    <div class="mb-4">
      <label for="img" class="form-label"><strong>Aggiungi il tuo logo personale</strong></label>
      <input class="form-control @error('img') is-invalid @enderror " type="file" id="img" name="img" value="{{ old('img') }}">
      @error('img')
          <div class="invalid-feedback">{{$message}}</div>
      @enderror
  </div>

  <div class="mb-4">
      <label for="phone_num" class="form-label"><strong>Numero di telefono</strong></label>
      <input class="form-control @error('phone_num') is-invalid @enderror " type="text" id="phone_num" name="phone_num" value="{{ old('phone_num') }}"></input>
      @error('phone_num')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
  </div>

  <div class="mb-4">
    <label for="bio" class="form-label brand-text-color-1"><strong>Racconta qualcosa riguardo la tua attività</strong></label>
    <textarea class="form-control @error ('bio') is-invalid @enderror " rows="8" id="bio" name="bio">{{ old('bio') }}</textarea>
    @error('bio')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
      
    <button type="submit" class="btn btn-primary mt-3">Salva</button>
</form>


@endsection