<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestauranteResource;
use App\Models\Restaurante;
use Illuminate\Http\Request;

class restauranteApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurante=Restaurante::with('usuario')->get();
        return RestauranteResource::collection($restaurante);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurante $restaurante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurante $restaurante)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurante $restaurante)
    {
        //
    }
}
