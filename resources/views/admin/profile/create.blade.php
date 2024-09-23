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
  <h5>Completa il tuo profilo con ulteriori informazioni</h5>
</div>

<form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
    @csrf 
    <div class="mb-4" >
      <label class="form-label"  for="organiser"><strong>Che tipo di professionista sei?</strong></label>
    <select class="form-select" aria-label="Default select example" id="organiser">
        <option value="">Seleziona l'opzione che più ti rappresenta</option>
        @foreach ($organiser as $singleOrganiser)
            <option @selected($singleOrganiser->id == old('singleOrganiser')) value="{{ $singleOrganiser->id }}">{{ Str::ucfirst($singleOrganiser->name) }}</option>
        @endforeach
    </select>
    </div>

    <div class="mb-4">
      <label for="photo" class="form-label"><strong>Aggiungi il tuo logo personale</strong></label>
      <input class="form-control @error('photo') is-invalid @enderror " type="file" id="photo" name="photo" value="{{ old('photo') }}">
      @error('photo')
          <div class="invalid-feedback">{{$message}}</div>
      @enderror
  </div>

  <div class="mb-4">
      <label for="telephone_number" class="form-label"><strong>Numero di telefono</strong></label>
      <input class="form-control @error('telephone_number') is-invalid @enderror " type="text" id="telephone_number" name="telephone_number" value="{{ old('telephone_number') }}"></input>
      @error('telephone_number')
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