<?php

namespace App\Http\Controllers;

use App\Models\Spot;
use App\Models\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Spot::query();

        if (!empty($keyword)) {
            $query = Spot::where('title', 'LIKE', "%{$keyword}%")
                ->orWhere('address', 'LIKE', "%{$keyword}%")
                ->orWhere('line', 'LIKE', "%{$keyword}%")
                ->orWhere('body', 'LIKE', "%{$keyword}%");
        }

        // $spots = Spot::orderBy('created_at', 'desc')->get();
        $spots = $query->orderBy('created_at', 'desc')->paginate(5);
        $user = auth()->user();

        return view('spot.index', compact('spots', 'user', 'keyword'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::any(['admin', 'user'])) {
            return view('spot.create');
        } else {
            return redirect()->route('spot.index')->with('message', 'ゲストユーザーは新規投稿ができません。');
        }
        
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

        if (request('image')) {
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
    public function edit(Request $request, Spot $spot)
    {
        // リクエストに関連付けられた認証済みユーザーが、特定の投稿 $spot を編集する権限があるかをチェック
        if ($request->user()->cannot('update', $spot)) {
            abort(403);
        }

        return view('spot.edit', compact('spot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spot $spot)
    {
        // リクエストに関連付けられた認証済みユーザーが、特定の投稿 $spot を編集する権限があるかをチェック
        if ($request->user()->cannot('update', $spot)) {
            abort(403);
        }

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

        if (request('image')) {
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
    public function destroy(Request $request, Spot $spot)
    {
        // リクエストに関連付けられた認証済みユーザーが、特定の投稿 $spot を削除する権限があるかをチェック
        if ($request->user()->cannot('delete', $spot)) {
            abort(403);
        }

        if ($spot->image) {
            $oldimage = 'images/' . $spot->image;
            Storage::disk('public')->delete($oldimage);
        }

        $spot->comments()->delete();
        $spot->delete();

        return redirect()->route('spot.index')->with('message', 'スポット情報を削除しました');
    }

    // 自分の投稿とコメント一覧表示用
    public function myspot()
    {
        $user = auth()->user()->id;
        $spots = Spot::where('user_id', $user)->orderBy('created_at', 'desc')->paginate(5);

        return view('spot.myspot', compact('spots'));
    }

    public function mycomment()
    {
        $user = auth()->user()->id;
        $comments = Comment::where('user_id', $user)->orderBy('created_at', 'desc')->paginate(5);

        return view('spot.mycomment', compact('comments'));
    }

    public function welcome()
    {
        $query = Spot::query();
        if (!$query) {
            $spots = [];
            return view('welcome', compact('spots'));
        }
        // $query = Spot::select('*');
        $query->whereNotNull('image');
        $query->get();
        $spots = $query->inRandomOrder()->take(4)->get();

        return view('welcome', compact('spots'));
    }
}
