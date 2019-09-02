<?php

namespace App\Services;

class MovieActor
{
    private static $table_name = '';

    private static function db()
    {
        return DB::table(self::$table_name);
    }

    public static function getMovieByActor($actor)
    {
        $where = [];
        $where[] = ['mainactor_name', '=', $actor];

        $movies = self::db()->where($where)->get();

        return array(
            'list' => $movies,
            'total' => count($movies->toArray())
        );
    }

}