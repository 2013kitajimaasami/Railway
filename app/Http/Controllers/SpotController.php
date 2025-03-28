<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('spot.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $spot = new Spot();
        $spot->user_id = auth()->user()->id;
        $spot->title = $request->title;
        $spot->body = $request->body;
        $spot->address = $request->address;
        $spot->line = $request->line;
        $spot->toilet = $request->toilet;
        $spot->parking = $request->parking;
        $spot->save();

        return redirect()->route('spot.create')->with('message', '新しいスポットを追加しました！');
    }

    /**
     * Display the specified resource.
     */
    public function show(Spot $spot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spot $spot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spot $spot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spot $spot)
    {
        //
    }
}
