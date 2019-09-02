<?php

namespace App\Services;

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

    public static function getByConditions(
        $title = null,
        $score_up = null, $score_down = null,
        $year_up = null, $year_down = null,
        $countries = null,
        $languages = null,
        $length_up = null, $length_down = null
    )
    {
        $where = [];
        self::buildWhere($where, 'title', $title);
        self::buildWhere($where, 'score', $score_up, '<');
        self::buildWhere($where, 'score', $score_down, '>');
        self::buildWhere($where, 'year', $year_up, '<');
        self::buildWhere($where, 'year', $year_down, '>');
        self::buildWhere($where, 'countries', $countries);
        self::buildWhere($where, 'languages', $languages);
        self::buildWhere($where, 'length', $length_up, '<');
        self::buildWhere($where, 'length', $length_down, '>');

        $movies = self::db()->where($where)->get();

        return array(
            'list' => $movies,
            'total' => count($movies->toArray())
        );
    }

    public static function buildWhere(&$arr, $column, $value, $t = '=')
    {
        if (!$value) {
            return;
        }
        $arr[] = [$column, $t, $value];
    }

}