<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserImageRequest;
use App\Models\Order;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \Auth::user();
        return view('users.show',[
            'title'=>'プロフィール',
            'user'=>$user,
            'orders'=>$user->orders
            ]);
        return redirect()->route('users.show');    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //$user =User::find($id);
        $user =\Auth::user();
        return view('users.edit',[
            'title' =>'プロフィール編集',
            'user'=>$user,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request)
    {
        $user = \Auth::user();
        $user->update($request->only(['name','profile']));
        session()->flash('success', '編集しました');
        return redirect()->route('users.show',auth()->user()->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function exhibitions($id){
        $items=\Auth::user()->items()->latest()->get();
        return view('users.exhibitions',[
            'title'=>'出品商品一覧',
            'items' =>$items
            ]);
    }
    
    public function editImage($id){
        $user = User::find($id);
        return view('users.edit_image',[
            'title' =>'画像変更画面',
            'user'=>$user,
            ]);
    }
    
    public function updateImage(UserImageRequest $request){
        
        $user = \Auth::user();
        $path = '';
        $image = $request->file('image');
        
        if( isset($image) === true ){
            $path =$image->store('photos','public');
        }
        if($user->image !== ''){
          \Storage::disk('public')->delete(\Storage::url($user->image));
        }
 
        $user->update([
          'image' => $path, 
        ]);
        session()->flash('success', '画像を変更しました');
        return redirect()->route('users.show',auth()->user()->id);
    }
}
