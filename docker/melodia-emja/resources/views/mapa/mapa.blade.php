@extends('layouts.layout')

@section('content')
@dd($musicos) <!-- Esto mostrará el contenido de $musicos -->
<div id="app">
    <map-component :users="{{ json_encode($musicos) }}"></map-component>
</div>
@endsection
