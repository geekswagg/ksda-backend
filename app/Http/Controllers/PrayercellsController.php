<?php

namespace App\Http\Controllers;

use App\Http\Resources\PrayercellResource;
use App\Models\Prayercells;
use Illuminate\Http\Request;

class PrayercellsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return Prayercells::all();
       return PrayercellResource::collection(Prayercells::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $prayercell_name = $request->input('name');

        $prayercell = Prayercells::create([
            'name' => $prayercell_name
        ]);

        return response() -> json([
            'data' => new PrayercellResource($prayercell)
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Prayercells $prayercell)
    {
        return new PrayercellResource($prayercell);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prayercells $prayercell)
    {
        $prayercell_name = $request-> input('name');

        $prayercell -> update([
            'name' => $prayercell_name
        ]);

        return response() -> json([
            'data' => new PrayercellResource($prayercell)
            
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prayercells $prayercell)
    {
        $prayercell -> delete(); 
        return response() -> json(null, 204);
    }
}
