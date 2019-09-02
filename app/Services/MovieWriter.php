<?php

namespace App\Services;

class MovieWriter
{
    private static $table_name = '';

    private static function db()
    {
        return DB::table(self::$table_name);
    }

    public static function getMovieByWriter($writer)
    {
        $where = [];
        $where[] = ['screenwriter_name', '=', $writer];

        $movies = self::db()->where($where)->get();

        return array(
            'list' => $movies,
            'total' => count($movies->toArray())
        );
    }

}