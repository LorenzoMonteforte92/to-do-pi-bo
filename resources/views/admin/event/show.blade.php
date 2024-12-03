@extends('layouts.admin')

@section('title') {{'Dashboard'}} 
@endsection

@section('content')
<div>
    <h5>img</h5>
    <img src="{{ asset('storage/' . $newEvent->img) }}" alt="{{ $newEvent->name }}">
</div>
<div>
    <h5>nome</h5>
    <p>{{ $newEvent->name }}</p>
</div>
<div>
    <h5>descrizione</h5>
    <p>{{ $newEvent->description }}</p>
</div>
<div>
    <h5>latitude</h5>
    <p>{{ $newEvent->latitude }}</p>
</div>
<div>
    <h5>longitude</h5>
    <p>{{ $newEvent->longitude }}</p>
</div>
<div>
    <h5>date</h5>
    <p>{{ $newEvent->date }}</p>
</div>
<div>
    <h5>time</h5>
    <p>{{ $newEvent->time }}</p>
</div>
<div>
    <h5>reservation_required</h5>
    <p>{{ $newEvent->reservation_required }}</p>
</div>
<div>
    <h5>cost</h5>
    <p>{{ $newEvent->cost }}</p>
</div>
<div>
    <h5>slug</h5>
    <p>{{ $newEvent->slug }}</p>
</div>
<div>
    <h5>id</h5>
    <p>{{ $newEvent->id }}</p>
</div>
@endsection