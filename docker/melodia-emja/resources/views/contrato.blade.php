@extends('layouts.layout')

@section('content')
{{-- @dd($musicos) <!-- Esto mostrará el contenido de $musicos --> --}}
<div id="app">
    <div id="app" usuario="{{ auth()->user()->id }}"></div>

    <contrato-component></contrato-component>  <!-- Renderiza el componente Vue -->
</div>
<div>id=</div>
@endsection




