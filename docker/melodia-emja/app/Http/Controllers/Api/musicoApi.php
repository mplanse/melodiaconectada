<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\musicoResource;
use App\Models\Musico;
use Illuminate\Http\Request;

class musicoApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $musicos=Musico::with('usuario')->get();
        return musicoResource::collection($musicos);

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
    public function show(Musico $musico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Musico $musico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Musico $musico)
    {
        //
    }
}
