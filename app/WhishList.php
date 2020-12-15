<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WhishList extends Model
{
    protected $fillable = [
'item_id',
'user_id' 

];
protected $table="wishlist";


public function getAuctionitem(){

        return $this->hasOne('App\AuctionItem','id','item_id');
    }
}
