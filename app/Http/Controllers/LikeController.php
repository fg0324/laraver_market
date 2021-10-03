<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Item;

class LikeController extends Controller
{
    public function index()
    {
        $like_items = \Auth::user()->likeitems()->latest()->get();
        return view('likes.index', [
          'title' => 'お気に入り一覧',
          'like_items' => $like_items,
        ]);
    }
 
    public function store(Request $request)
    {
        //
    }
 
    public function destroy($id)
    {
        //
    }
    
    public function __construct()
    {
        $this->middleware('auth');
    }
}