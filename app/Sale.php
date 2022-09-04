<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    protected $table = 'sales';
    protected $guarded = array('id');


    protected $fillable = [
        'user_id',
        'bank_id',
        'price',
        'transfer_fee',
        'transfer_fee_real',
        'transfer_flg',
        'request_at',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }


}
