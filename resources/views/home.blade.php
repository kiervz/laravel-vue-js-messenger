@extends('layouts.app')

@section('content')
    <div class="app-body" id="app">
        <app-home :user="{{ auth()->user() }}"></app-home>
    </div>
@endsection
