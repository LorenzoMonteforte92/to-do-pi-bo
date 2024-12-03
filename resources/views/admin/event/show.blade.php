@extends('layouts.admin')

@section('title') {{ $event->slug }} 
@endsection

@section('content')
<div>
    <h5>img</h5>
    <img src="{{ asset('storage/' . $event->img) }}" alt="{{ $event->name }}">
</div>
<div>
    <h5>nome</h5>
    <p>{{ $event->name }}</p>
</div>
<div>
    <h5>descrizione</h5>
    <p>{{ $event->description }}</p>
</div>
<div>
    <h5>latitude</h5>
    <p>{{ $event->latitude }}</p>
</div>
<div>
    <h5>longitude</h5>
    <p>{{ $event->longitude }}</p>
</div>
<div>
    <h5>date</h5>
    <p>{{ $event->date }}</p>
</div>
<div>
    <h5>time</h5>
    <p>{{ $event->time }}</p>
</div>
<div>
    <h5>reservation_required</h5>
    <p>{{ $event->reservation_required }}</p>
</div>
<div>
    <h5>cost</h5>
    <p>{{ $event->cost }}</p>
</div>
<div>
    <h5>slug</h5>
    <p>{{ $event->slug }}</p>
</div>
<div>
    <h5>id</h5>
    <p>{{ $event->id }}</p>
</div>
@endsection