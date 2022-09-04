<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayCount extends Model
{
    protected $guarded = array('id');
    protected $fillable = ['user_id', 'item_id', 'ip_address'];
    protected $table = 'play_counts';

    //
}
