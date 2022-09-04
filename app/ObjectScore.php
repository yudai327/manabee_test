<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObjectScore extends Model
{
    protected $guarded = array('id');
    protected $fillable = ['score', 'user_id', 'item_id', 'comment'];
    protected $table = 'object_scores';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
