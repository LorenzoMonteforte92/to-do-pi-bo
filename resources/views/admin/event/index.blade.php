@extends('layouts.admin')

@section('title') {{'I tuoi eventi'}} 
@endsection

@section('content')
   <div class="container">
    <h1>Eventi</h1>
    @if ($events->isEmpty())
        <div class="row mt-4">
            <div class="col d-flex flex-column align-items-center">
                <h3 class="mb-3" >Non hai ancora eventi in programma</h3>
                <div><a href="{{route('admin.event.create')}}" class="btn btn-primary" >Pubblica il tuo primo evento</a></div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col"></div>
    </div>
   </div>
@endsection