<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
  protected $fillable = [
'email',
'description' ,
'create_datetime',
'is_softdel',
'status'

];

protected $table="subscriber";
}
