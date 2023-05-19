<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airport;

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $airports = Airport::all();
        return view('airports.index', compact('airports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('airports.create');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required',
            'city_code' => 'required',
            'name' => 'required',
            'city' => 'required',
            'country_code' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'timezone' => 'required',
        ]);

        Airport::create($data);

        return redirect()->route('airports.index')->with('success', 'Airport created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $airport = Airport::findOrFail($id);
        return view('airports.show', compact('airport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $airport = Airport::findOrFail($id);
        return view('airports.edit', compact('airport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $data = $request->validate([
            'code' => 'required',
            'city_code' => 'required',
            'name' => 'required',
            'city' => 'required',
            'country_code' => 'required',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'timezone' => 'required',
        ]);

        $airport = Airport::findOrFail($id);
        $airport->update($data);

        return redirect()->route('airports.index')->with('success', 'Airport updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $airport = Airport::findOrFail($id);
        $airport->delete();

        return redirect()->route('airports.index')->with('success', 'Airport deleted successfully.');
    }
}
