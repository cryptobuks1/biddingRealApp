<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class General extends Model
{
     protected $fillable = [
'address',
'address2',
'phone',
'howtoBid' ,
'howtoBidimg',


];

protected $table="general";
}
