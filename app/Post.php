<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
'post_type',
'is_softdel',

];

protected $table="posts";

}
