@extends('layouts.app')

@section('content')
    <div id="app">
        <app-home :user="{{ auth()->user() }}"></app-home>
    </div>
@endsection
