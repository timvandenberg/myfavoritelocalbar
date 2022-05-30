<?php

namespace App\Http\Controllers;

use App\Models\Town;
use Illuminate\Http\Request;

class TownController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->validate([
            's' => 'required',
        ]);

        $places = Town::where('name', 'LIKE', '%'.$request->s.'%')->get();
        if($places) {
            $placesArray = [];
            foreach ($places as $place) {
                $obj = (object) array('name' => $place->name);
                array_push($placesArray, $obj);
            }
            return response()->json($placesArray);
        }
        return response()->json([]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Town  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Town $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Town  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Town $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Town  $place
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Town $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Town  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Town $place)
    {
        //
    }
}
