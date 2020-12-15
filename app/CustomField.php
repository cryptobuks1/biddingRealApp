<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomField extends Model
{
    protected $fillable = [
'name',
'slug',
'post_type',
'css_class',
'css_id',
'field_type',
'is_softdel',
'placeholder',
'required',
'status'

];

protected $table="custom_fields";	
}
