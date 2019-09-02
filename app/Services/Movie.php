<?php

namespace App\Services\Movie;

use Illuminate\Support\Facades\DB;

class Movie
{
    private static $table_name = '';

    private static function db()
    {
        return DB::table(self::$table_name);
    }

    public static function getMovieById($id)
    {
        $where = [];
        $where[] = ['id', '=', $id];
        return self::db()
            ->where($where)
            ->first();
    }

    public static function getMovieByDoubanId($douban_id)
    {
        $where = [];
        $where[] = ['douban_id', '=', $douban_id];
        return self::db()->where($where)->first();
    }

    public static function doubanIdToId($douban_id)
    {
        $where = [];
        $where[] = ['douban_id', '=', $douban_id];
        $movie = self::getMovieByDoubanId($douban_id);
        return $movie ? $movie->id : false;
    }


}