<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $fillable = [
    	'user_id', 'subject', 'order_id', 'charge_id', 'description', 'resolved_at', 'post_id', 'post_slug', 'post_price', 'poster_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id')->withTrashed();
    }

    public function order()
    {
        return $this->belongsTo('App\User', 'order_id');
    }

}
