@extends('layouts.admin')
@section('title') {{'Crea Profilo'}} 
@endsection

@section('content')

<h2>Benvenut* {{ $user->name }}</h2>

<form action="{{ route('admin.profile.store') }}" method="POST" enctype="multipart/form-data">
    @csrf 

    <select class="form-select" aria-label="Default select example">
        <option selected>Open this select menu</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


@endsection