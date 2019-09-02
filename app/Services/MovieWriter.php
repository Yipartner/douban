<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class MovieWriter
{
    public static $table_name = 'screenwriters';

    private static function db()
    {
        return DB::table(self::$table_name);
    }

    public static function getMovieByWriter($writer)
    {
        $where = [];
        $where[] = ['screenwriter_name', '=', $writer];

        $movies = self::db()->where($where)
            ->join(Movie::$table_name, sprintf('%s.movie_id', self::$table_name), '=', sprintf('%s.id', Movie::$table_name))
            ->get();

        return array(
            'list' => $movies,
            'total' => count($movies->toArray())
        );
    }

    public static function getCount()
    {
        return self::db()
            ->select(DB::raw('count(*) as movie_count, screenwriter_name'))
            ->groupBy('screenwriter_name')
            ->orderBy('movie_count', 'desc')
            ->limit(100)
            ->get();
    }

}