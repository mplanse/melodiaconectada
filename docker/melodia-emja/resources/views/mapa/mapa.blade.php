@extends('layouts.layout')

@section('content')
{{-- @dd($musicos) <!-- Esto mostrará el contenido de $musicos --> --}}
<div id="app">
    <map-component :user="{{ json_encode(Auth::user()) }}"></map-component>
</div>
@endsection
