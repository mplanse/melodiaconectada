@extends('layouts.layout')

@section('content')
<div id="app">
    <map-component :user="{{ json_encode(Auth::user()) }}"></map-component>
</div>
@endsection
