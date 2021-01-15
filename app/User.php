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
        'name', 'email', 'password', 'image'
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
    ];

    // 更新用のルール
    public static $rulesUpdate = [
        'name' => ['required', 'string', 'max:30'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['confirmed'],
        'image' => ['file', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
];

    /**
    * リレーション
    *
    * User has many Questions
    */

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    /**
    * リレーション
    *
    * User has many Anwswers
    */

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($user) {
            $user->questions()->delete();
        });

        static::deleting(function($user) {
            $user->answers()->delete();
        });
    }

}
