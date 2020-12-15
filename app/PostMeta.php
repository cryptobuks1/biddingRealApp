<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
 protected $fillable = [
'post_id',
'meta_key',
'meta_value',
'post_type',
'field_type'

];

protected $table="postsmeta";
}
