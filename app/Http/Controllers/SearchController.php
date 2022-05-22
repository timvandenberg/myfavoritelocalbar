<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchStep1()
    {
        return view('search.step-1', [
        ]);
    }

    public function searchStep2(Request $request)
    {
        $request->validate([
            'local_city' => 'required'
        ]);

        $request->session()->put('key', 'value');
        $request->session()->push('searchStep1', $request->all());

        return view('search.step-2', [
            //
        ]);
    }

    public function searchStep3(Request $request)
    {
        $request->validate([
            'bar' => 'required'
        ]);

        $request->session()->push('searchStep2', $request->all());

        return view('search.step-3', [
            //
        ]);
    }

    public function searchStep4(Request $request)
    {
        $request->validate([
            'current_location' => 'required'
        ]);

        $location = $request->all()['current_location'];
        $localCity = $request->session()->all()['searchStep1'][array_key_last($request->session()->all()['searchStep1'])]['local_city'];
        $bar = $request->session()->all()['searchStep2'][array_key_last($request->session()->all()['searchStep2'])]['bar'];

        return view('map', [
            //
        ]);
    }
}
