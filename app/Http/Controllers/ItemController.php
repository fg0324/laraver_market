<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Like;
use App\Models\Order;
use App\Models\Category;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemImageRequest;
use App\Http\Requests\ItemCreateRequest;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         $items = Item::where('user_id', '<>',\Auth::user()->id)->orderby('created_at','desc')->get();
         return view('items.index', [
          'title' => 'トップページ',
          'items' =>$items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create',[
            'title'=>'商品を出品',
            'categories' => Category::all(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemCreateRequest $request)
    {
        $path='';
        $image=$request->file('image');
        if( isset($image) === true ){
            $path = $image->store('photos', 'public');
        }
        
        Item::create([
            'user_id'=> \Auth::user()->id,
            'name'=> $request->name,
            'price'=>$request->price,
            'description'=>$request->description,
            'category_id'=> $request->category,
            'image'=>$path,
            ]);
            session()->flash('success', '追加しました');
            return redirect()->route('users.exhibitions',auth()->user()->id);
    } 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item =Item::find($id);
        return view('items.show', [
          'title' => '商品詳細',
          'item'=>$item,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item =Item::find($id);
        return view('items.edit', [
          'title' => '商品情報の編集',
          'item'=>$item,
          'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, $id)
    {
        $item=Item::find($id);
        $item->update($request->only(['name','description','price','category_id','image']));
        session()->flash('success', '更新しました');
        return redirect()->route('items.show',$item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item =Item::find($id);
        $item->delete();
        \Session::flash('success', '削除しました');
        return redirect()->route('items.index');
    }
    
    public function editImage($id)
    {
        $item =Item::find($id);
        return view('items.edit_image',[
            'title'=>'商品画像の変更',
            'item'=>$item,
            ]);
    }
    
    public function updateImage($id,ItemImageRequest $request){
        $path='';
        $image=$request->file('image');
        
        if(isset($image)===true){
            $path =$image->store('photos','public');
        }
        
        $item =Item::find($id);
        if($item->image !==''){
            \Storage::disk('public')->delete(\Storage::url($item->image));
        }
        
        $item->update([
            'image'=>$path,
            ]);
        
        session()->flash('success', '画像を変更しました');
        return redirect()->route('items.show',$item);    
    }
    
    
    
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function toggleLike($id){
        $user = \Auth::user();
        $item = Item::find($id);
        
        if($item->isLikedBy($user)){
            $item->likes->where('user_id',$user->id)->first()->delete();
            \Session::flash('success', 'いいねを取り消しました');
        }else{
            Like::create([
                'user_id'=>$user->id,
                'item_id'=>$item->id,
                ]);
                \Session::flash('success', 'いいねしました');
        }
        return redirect('/items');
        
    }
    
    public function comfirm($id){
        $item =Item::find($id);
        return view('items.comfirm', [
          'title' => '購入確認画面',
          'item'=>$item,
        ]);
    }
    
    public function finish($id){
        
        $user =\Auth::user();
        $item =Item::find($id);
        Order::create([
            'user_id'=>$user->id,
            'item_id'=>$item->id,
            ]);
        return view('items.finish', [
          'title' => '購入完了画面',
          'item'=>$item,
        ]);
    }
}