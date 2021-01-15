<?php

use Illuminate\Database\Seeder;

class AnswersTableSeader extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new DateTime();
        $date->setDate(2020,12,15);

        $param = [
            'user_id' => 3,
            'question_id' => 1,
            'body' => 'body1-1',
             'created_at' => $date,
             'updated_at' => $date,
        ];

        DB::table('answers')->insert($param);

        $date = new DateTime();
        $date->setDate(2020,12,16);

        $param = [
            'user_id' => 1,
            'question_id' => 2,
            'body' => 'body2-1',
            'created_at' => $date,
            'updated_at' => $date,
        ];

        DB::table('answers')->insert($param);

        $date = new DateTime();
        $date->setDate(2020,12,17);

        $param = [
            'user_id' => 2,
            'question_id' => 1,
            'body' => 'body1-2',
            'created_at' => $date,
            'updated_at' => $date,
        ];

        DB::table('answers')->insert($param);

        $date = new DateTime();
        $date->setDate(2020,12,18);

        $param = [
            'user_id' => 3,
            'question_id' => 1,
            'body' => 'body1-3',
             'created_at' => $date,
             'updated_at' => $date,
        ];

        DB::table('answers')->insert($param);

        $date = new DateTime();
        $date->setDate(2020,12,19);

        $param = [
            'user_id' => 1,
            'question_id' => 3,
            'body' => 'body3-1',
            'created_at' => $date,
            'updated_at' => $date,
        ];

        DB::table('answers')->insert($param);

        $date = new DateTime();
        $date->setDate(2020,12,20);

        $param = [
            'user_id' => 2,
            'question_id' => 3,
            'body' => 'body2-2',
            'created_at' => $date,
            'updated_at' => $date,
        ];

        DB::table('answers')->insert($param);
    }
}
