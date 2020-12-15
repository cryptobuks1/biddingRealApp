<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conditions extends Model
{
      protected $fillable = [
'ac_parent_id',
'ac_parent_child_id',
'inc_amount',
'status',
'is_softdel',

];

protected $table="biddingconditions";
}
