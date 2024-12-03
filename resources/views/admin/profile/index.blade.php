@extends('layouts.admin')

@section('title') {{'Dashboard'}} 
@endsection

@section('content')
<h4 class="text-secondary my-4">
    {{ __('Benvenut* nella tua Dashboard ' . $user->name) }}
</h4>
<div class="container">
    <h5>{{ __('I tuoi prossimi eventi') }}</h5>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('evento1') }}</div>

                <div class="card-body">
                    {{ __('blabla') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection