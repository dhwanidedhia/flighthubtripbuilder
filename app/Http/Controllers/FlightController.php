<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use Illuminate\Support\Facades\Validator;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flights = Flight::all();
        return view('flights.index', compact('flights'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flights.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'airline' => 'required|exists:airlines,code',
            'number' => 'required|unique:flights,number',
            'departure_airport' => 'required|exists:airports,code',
            'departure_time' => 'required',
            'arrival_airport' => 'required|different:departure_airport|exists:airports,code',
            'duration' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
		
		if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
		
		$data = $request->all();

        Flight::create($data);

        return redirect()->route('flights.index')->with('success', 'Flight created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $flight = Flight::findOrFail($id);
        return view('flights.show', compact('flight'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $flight = Flight::findOrFail($id);
        return view('flights.edit', compact('flight'));
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
        $validator = Validator::make($request->all(), [
            'airline' => 'required|exists:airlines,code',
            'number' => 'required|unique:flights,number,' . $id,
            'departure_airport' => 'required|exists:airports,code',
            'departure_time' => 'required',
            'arrival_airport' => 'required|different:departure_airport|exists:airports,code',
            'duration' => 'required|numeric',
            'price' => 'required|numeric',
        ]);
		
		if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
		
		$data = $request->all();

        $flight = Flight::findOrFail($id);
        $flight->update($data);

        return redirect()->route('flights.index')->with('success', 'Flight updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flight = Flight::findOrFail($id);
        $flight->delete();

        return redirect()->route('flights.index')->with('success', 'Flight deleted successfully.');
    }
}
