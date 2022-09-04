<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Push extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function item()
    {
        return $this->belongsTo('App\Item');
    }
    public function reads()
    {
        return $this->hasMany('App\Read');
    }
    protected $guarded = array('id');

    // table名を指定
    protected $table = 'pushes';

    // カラムを指定
    protected $fillable = ['comment','status','user_id'];

}
