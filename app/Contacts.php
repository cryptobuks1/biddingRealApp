<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
 protected $fillable = [
'name',
'email',
'description',
'subject',
'phone',
'is_agree',
'create_datetime',
'is_softdel',
'status'

];

protected $table="contacts";
}
