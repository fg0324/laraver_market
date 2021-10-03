<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['user_id', 'name', 'description','category_id','price','image'];
    
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
    
    public function likes(){
        return $this->hasMany('App\Models\Like');
    }
    public function likedUsers(){
        return $this->belongsToMany('App\Models\User','likes');
    }
    public function isLikedBy($user){
      $liked_users_ids = $this->likedUsers->pluck('id');
      $result = $liked_users_ids->contains($user->id);
      return $result;
    }
    public function isOrdered(){

       if(count(Order::where('item_id',$this->id)->get())>0){
           return true;
       }
       return false;
    }

}

