<?php

namespace App\Http\Controllers;

use App\Models\Bar;
use App\Models\Town;
use App\Models\BarConnection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allBars = Bar::all();

        return view('bars.index', [
            'bars' => $allBars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'google_place_description' => 'required',
            'google_place_id' => 'required',
            'name' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'street_nr' => 'required',
            'street' => 'required',
            'town' => 'required',
            'country' => 'required',
        ]);

        $town = Town::where('name', $request->town)->first();
        if (!$town) {
            $town = new Town;
            $town->fill([
                'name' => $request->town
            ]);
            $town->save();
        }

        $bar = new Bar;
        $bar->fill(['town_id' => $town->id]);
        $bar->fill($request->all());
        $bar->save();

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bar  $bar
     * @return \Illuminate\Http\Response
     */
    public function show(Bar $bar)
    {
        $allBars = Bar::where('id', '!=', $bar->id)->get();

        $barConnections = [];
        foreach($bar->connections as $connection) {
            $barC = Bar::where('id', $connection->connected_bar_id)->first();
            
            if (array_key_exists($barC->name, $barConnections)) {
                $similarityTemp = $barConnections[$barC->name];
                $similarityTemp[] = $connection->similarity;
                $barConnections[$barC->name] = $similarityTemp;
            } else {
                $barConnections[$barC->name] = [$connection->similarity];
            }

        }

        return view('bars.show', [
            'thisBar' => $bar,
            'otherBars' => $allBars,
            'connections' => $barConnections
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bar  $bar
     * @return \Illuminate\Http\Response
     */
    public function edit(Bar $bar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bar  $bar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bar $bar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bar  $bar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bar $bar)
    {
        //
    }

    /**
     * connection
     *
     * @param  \App\Models\Bar  $bar
     * @return \Illuminate\Http\Response
     */
    public function connection(Request $request, Bar $bar)
    {
        $request->validate([
            'bar_id' => 'required',
            'connected_bar_id' => 'required',
            'similarity' => 'required'
        ]);

        $allInput = $request->all();
        $userId = Auth::id();

        $barConnection = new BarConnection;
        $barConnection->fill([
            'bar_id' => $allInput['bar_id'],
            'connected_bar_id' => $allInput['connected_bar_id'],
            'similarity' => $allInput['similarity'],
            'user_id' => $userId,
        ]);
        $barConnection->save();

        $bar = Bar::where('id', $allInput['bar_id'])->first();

        return $this->show($bar);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bar  $bar
     * @return \Illuminate\Http\Response
     */
    public function getBars(Request $request)
    {
        dd($request->all());
//        $allBars = Bar::where('id', '!=', $bar->id)->get();
    }

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

        $bars = Bar::where('google_place_description', 'LIKE', '%'.$request->s.'%')->get();
        if($bars) {
            $barsArray = [];
            foreach ($bars as $b) {
                $obj = (object) array('description' => $b->google_place_description);
                array_push($barsArray, $obj);
            }
            return response()->json($barsArray);
        }
        return response()->json([]);
    }
}
