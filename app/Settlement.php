<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model
{
    protected $guarded = array('id');

    public function item()
    {
        return $this->belongsTo('App\Item');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
