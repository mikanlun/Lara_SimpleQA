<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeader extends Seeder
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
            'user_id' => 1,
            'title' => 'title1-1',
            'body' => 'body1-1',
             'created_at' => $date,
             'updated_at' => $date,
        ];

        DB::table('questions')->insert($param);

        $date = new DateTime();
        $date->setDate(2020,12,16);

        $param = [
            'user_id' => 2,
            'title' => 'title2-1',
            'body' => 'body2-1',
            'created_at' => $date,
            'updated_at' => $date,
        ];

        DB::table('questions')->insert($param);

        $date = new DateTime();
        $date->setDate(2020,12,17);

        $param = [
            'user_id' => 1,
            'title' => 'title1-2',
            'body' => 'body1-2',
            'created_at' => $date,
            'updated_at' => $date,
        ];

        DB::table('questions')->insert($param);

        $date = new DateTime();
        $date->setDate(2020,12,18);

        $param = [
            'user_id' => 1,
            'title' => 'title1-3',
            'body' => 'body1-3',
             'created_at' => $date,
             'updated_at' => $date,
        ];

        DB::table('questions')->insert($param);

        $date = new DateTime();
        $date->setDate(2020,12,19);

        $param = [
            'user_id' => 3,
            'title' => 'title3-1',
            'body' => 'body3-1',
            'created_at' => $date,
            'updated_at' => $date,
        ];

        DB::table('questions')->insert($param);

        $date = new DateTime();
        $date->setDate(2020,12,20);

        $param = [
            'user_id' => 2,
            'title' => 'title2-2',
            'body' => 'body2-2',
            'created_at' => $date,
            'updated_at' => $date,
        ];

        DB::table('questions')->insert($param);

    }
}
