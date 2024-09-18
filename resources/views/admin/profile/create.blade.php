@extends('layouts.admin')
@section('title') {{'Crea Profilo'}} 
@endsection

@section('content')

<div class="mb-5" >
  <h2 class="mb-3" >Benvenut* {{ $user->name }}</h2>
  <h5>Completa il tuo profilo con ulteriori informazioni</h5>
</div>

<form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
    @csrf 
<label class="ps-2 pb-2"  for="organiser">Che tipo di professionista sei?</label>
    <select class="form-select" aria-label="Default select example" id="organiser">
        <option value="">Seleziona l'opzione che più ti rappresenta</option>
        @foreach ($organiser as $singleOrganiser)
            <option @selected($singleOrganiser->id == old('singleOrganiser')) value="{{ $singleOrganiser->id }}">{{ Str::ucfirst($singleOrganiser->name) }}</option>
        @endforeach
        
      </select>
      
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


@endsection