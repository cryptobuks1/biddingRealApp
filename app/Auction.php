<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Auction extends Model
{
protected $fillable = [
'title',
'slug',
'post_type',
'description' ,
'start_datetime',
'end_datetime',
'featured_img',
'org_name',
'org',
'author',
'is_softdel',
'status'

];

protected $table="auctions";

}