<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password', 'countryCode', 'number', 'image', 'coverImage', 'theme_id', 'role_id', 'address', 'gender_id', 'birthDate', 'profession', 'aboutMe', 'userName',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthDate' => 'datetime',
    ];

    public function theme(){
        return $this->belongsTo(Theme::class, 'theme_id');
    }

    public function role(){
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function gender(){
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function checkRole(){
        return $this->role_id;
    }
}
