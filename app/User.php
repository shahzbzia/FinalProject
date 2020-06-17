<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Overtrue\LaravelFollow\Followable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable
{
    use Notifiable;
    use Followable;
    use SoftDeletes;
    use SearchableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password', 'countryCode', 'number', 'image', 'coverImage', 'theme_id', 'role_id', 'address', 'gender_id', 'birthDate', 'profession', 'aboutMe', 'userName', 'recipientId', 'ammo'
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

    public function posts(){
        return $this->hasMany(Post::class)->whereNotNull('title')->whereNotNull('slug')->withTrashed();
    }

    public function emptyPosts(){
        return $this->hasMany(Post::class)->whereNull('title')->whereNull('slug');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }

    public function comments(){

        return $this->hasMany(Comment::class);

    }
    
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function issues()
    {
        return $this->hasMany('App\Issue');
    }

    protected $searchable = [
        /**
         * Columns and their priority in search results.
         * Columns with higher values are more important.
         * Columns with equal values have equal importance.
         *
         * @var array
         */
        'columns' => [
            'users.id' => 5,
            'users.userName' => 10,
            'users.firstName' => 10,
            'users.lastName' => 10,

        ],
    ];
}
