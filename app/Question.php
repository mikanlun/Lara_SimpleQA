<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = ['id'];

    /**
     * リレーション
     *
     * Question belongs to User
     */

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
    * リレーション
    *
    * Question has many Answers
    */

    public function answers()
    {
        return $this->hasMany('App\Answer')
                ->orderBy('answers.best_flg', 'desc');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($question) {
            $question->answers()->delete();
        });
    }

}
