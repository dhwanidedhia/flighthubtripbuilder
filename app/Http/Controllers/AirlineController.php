<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airline;
use Illuminate\Support\Facades\Validator;

class AirlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $airlines = Airline::all();
        return view('airlines.index', compact('airlines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('airlines.create');
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
            'code' => 'required|unique:airlines',
            'name' => 'required',
        ]);
		
		if ($validator->fails()) {
            return redirect('airlines/create')->withErrors($validator)->withInput();
        }
		
		$data = $request->all();
		
        Airline::create($data);

        return redirect()->route('airlines.index')->with('success', 'Airline created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $airline = Airline::findOrFail($id);
        return view('airlines.show', compact('airline'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $airline = Airline::findOrFail($id);
        return view('airlines.edit', compact('airline'));
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
            'code' => 'required|unique:airlines,code,' . $id,
            'name' => 'required',
        ]);
		
		if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
		
		$data = $request->all();
		
        $airline = Airline::findOrFail($id);
        $airline->update($data);

        return redirect()->route('airlines.index')->with('success', 'Airline updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $airline = Airline::findOrFail($id);
        $airline->delete();

        return redirect()->route('airlines.index')->with('success', 'Airline deleted successfully.');
    }
}
