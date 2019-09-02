<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class MovieTag
{

    public static $table_name = 'tags';

    private static function db()
    {
        return DB::table(self::$table_name);
    }

    public static function getMovieByTag($tag)
    {
        $where = [];
        $where[] = ['tags.tag_name', '=', $tag];

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
            ->select(DB::raw('count(*) as movie_count, tag_name'))
            ->groupBy('tag_name')
            ->orderBy('movie_count', 'desc')
            ->limit(100)
            ->get();
    }

}