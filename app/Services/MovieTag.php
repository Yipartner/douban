<?php

namespace App\Services;

class MovieTag
{

    private static $table_name = '';

    private static function db()
    {
        return DB::table(self::$table_name);
    }

    public static function getMovieByTag($tag)
    {
        $where = [];
        $where[] = ['tag_name', '=', $tag];

        $movies = self::db()->where($where)->get();

        return array(
            'list' => $movies,
            'total' => count($movies->toArray())
        );
    }

}