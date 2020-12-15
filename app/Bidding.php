<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
  protected $fillable = [
'ac_parent_id',
'ac_parent_child_id',
'user_id',
'amount',
'bdatetime',
'win',
'sold',
'status',
'is_softdel',

];

protected $table="auctionsbidding";

public function getAuction(){

        return $this->hasOne('App\Auction','id','ac_parent_id');
    }

 public function getAuction2(){
 
        return $this->hasMany('App\Auction','id','ac_parent_id');
    }

     public function getAuctionItem(){

        return $this->hasOne('App\AuctionItem','id','ac_parent_child_id');
    }

     public function getAuctionItem2(){
 
        return $this->hasMany('App\AuctionItem','id','ac_parent_child_id');
    }

     public function getUser(){

        return $this->hasOne('App\User','id','user_id');
    }

}
