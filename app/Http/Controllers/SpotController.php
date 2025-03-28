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
        $spots = Spot::orderBy('created_at', 'desc')->get();
        $user = auth()->user();

        return view('spot/index', compact('spots', 'user'));
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
        $inputs = request()->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:1000',
            'address' => 'required|max:255',
            'line' => 'max:1000',
            'toilet' => 'max:255',
            'parking' => 'max:255',
            'image' => 'image|max:1024',
        ]);

        $spot = new Spot();
        $spot->user_id = auth()->user()->id;
        $spot->title = $inputs['title'];
        $spot->body = $inputs['body'];
        $spot->address = $inputs['address'];
        $spot->line = $inputs['line'];
        $spot->toilet = $inputs['toilet'];
        $spot->parking = $inputs['parking'];

        if(request('image')) {
            $original = request()->file('image')->getClientOriginalName();
            $name = date('Ymd_His') . '_' . $original;
            request()->file('image')->move('storage/images', $name);
            $spot->image = $name;
        }

        $spot->save();

        return redirect()->route('spot.create')->with('message', '新しいスポットを追加しました！');
    }

    /**
     * Display the specified resource.
     */
    public function show(Spot $spot)
    {
        return view('spot.show', compact('spot'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spot $spot)
    {
        return view('spot.edit', compact('spot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spot $spot)
    {
        $inputs = request()->validate([
            'title' => 'required|max:255',
            'body' => 'required|max:1000',
            'address' => 'required|max:255',
            'line' => 'max:1000',
            'toilet' => 'max:255',
            'parking' => 'max:255',
            'image' => 'image|max:1024',
        ]);

        $spot->title = $inputs['title'];
        $spot->body = $inputs['body'];
        $spot->address = $inputs['address'];
        $spot->line = $inputs['line'];
        $spot->toilet = $inputs['toilet'];
        $spot->parking = $inputs['parking'];

        if(request('image')) {
            $original = request()->file('image')->getClientOriginalName();
            $name = date('Ymd_His') . '_' . $original;
            request()->file('image')->move('storage/images', $name);
            $spot->image = $name;
        }

        $spot->save();

        return redirect()->route('spot.show', $spot)->with('message', 'スポット情報を更新しました！');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spot $spot)
    {
        $spot->delete();

        return redirect()->route('spot.index')->with('message', 'スポット情報を削除しました');
    }
}
