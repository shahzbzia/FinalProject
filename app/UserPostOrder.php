<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPostOrder extends Model
{
    protected $table = 'user_post_order';

    protected $fillable = ['user_id', 'post_id', 'order_id'];

    public function post()
	{
	    return $this->belongsTo('App\Post', 'post_id');
	}

	public function order()
	{
	    return $this->belongsTo('App\Order', 'order_id');
	}
}
