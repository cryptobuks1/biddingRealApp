<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionItem extends Model
{
    


 protected $fillable = [
'ac_parent_id',
'user_id',
'title',
'start_price' ,
'slug',
'post_type',
'gallery',
'upload_video',
'video_link',
'start_datetime',
'end_datetime',
'status',
'is_softdel',
'description'

];

protected $table="auctionschildposts";

   
 

public function getAuctionBidding(){
 
        return $this->hasMany('App\Bidding','ac_parent_child_id','id');
    }


  public function getAuctionPostMeta(){
  
        return $this->hasMany('App\PostMeta','post_id','id');
    }

}
