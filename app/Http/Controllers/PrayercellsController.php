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
       $data = PrayercellResource::collection(Prayercells::all());
       return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = $request->input('name');
        $leader = $request->input('leader');
        $contact = $request->input('contact');

        $prayercell = Prayercells::create([
            'name' => $name,
            'leader' => $leader,
            'contact' => $contact
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
        $data = new PrayercellResource($prayercell);
        return response()-> json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prayercells $prayercell)
    {
        $name = $request-> input('name');
        $leader = $request-> input('leader');
        $contact = $request-> input('contact');

        $prayercell -> update([
            'name' => $name,
            'leader' => $leader,
            'contact' => $contact
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
