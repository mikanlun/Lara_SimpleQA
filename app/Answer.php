<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $guarded = ['id'];

    /**
     * リレーション
     *
     * Answer belongs to User
     */

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
    * リレーション
    *
    * Answer bilongs to Question
    */

    public function question()
    {
        return $this->belongsTo('App\Question');
    }

}
