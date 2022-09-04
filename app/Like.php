<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    protected $guarded = array('id');

	protected $fillable = [
        'user_id',
        'item_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //いいねしている投稿
    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}
