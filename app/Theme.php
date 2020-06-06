<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'name', 'value',
    ];

	public function user(){
        return $this->hasMany(User::class)->withTrashed();
    }
}
