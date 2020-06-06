<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'billing_email', 'billing_address', 'billing_name_on_card', 'billing_total', 'stripe_charge_id', 'issue_created_at', 'issue_resolved_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id')->withTrashed();
    }

    public function posts()
    {
        return $this->belongsToMany('App\Post')->withTrashed();
    }

    public function issues()
    {
        return $this->hasMany('App\Issue');
    }
}
