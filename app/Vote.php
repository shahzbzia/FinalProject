<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
	protected $fillable = [
        'post_id', 'user_id', 'vote',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User', 'user_id')->withTrashed();
    }

    public function post()
    {
    	return $this->belongsTo('App\Post', 'post_id')->withTrashed();
    }
}
