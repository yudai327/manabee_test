<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
	protected $table = 'items';
	// protected $fillable = ['comment', 'title'];
	protected $guarded = array('id');

	protected $fillable = [
		'user_id',
		'title',
		'detail',
		'price',
		'path',
		'image_path',
		'preview_id',
		'preview_flg',
		'release_flg',
		'convert_flg',
		'pre_convert_flg',
		'delete_flg',
		'free_flg',
		'video_time',
	];

	public function user()
	{
		return $this->belongsTo('App\User');
	}
	public function object_scores()
	{
		return $this->hasMany('App\ObjectScore');
	}
	public function settlements()
	{
		return $this->hasMany('App\Settlement');
	}
	public function item_settlements()
	{
		return $this->hasMany('App\Settlement')
		->select([
			'created_at as settlement_at',
			'price as settlement_price',
			'item_id',
			'user_id as settlement_user_id'
		]);
	}
	public function preitem()
	{
		return $this->hasOne('App\Item','id','preview_id');
	}
	public function play_counts()
	{
		return $this->hasMany('App\PlayCount');
	}
	public function likes()
	{
		return $this->hasMany('App\Like');
	}

}
