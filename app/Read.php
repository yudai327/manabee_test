<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Read extends Model
{
    //
    // table名を指定
    protected $table = 'reads';

    // カラムを指定
    protected $fillable = ['read_user_id','push_id','read_at'];

    protected $guarded = array('id');

    public function push()
    {
        return $this->belongsTo('App\Push');
    }


}
