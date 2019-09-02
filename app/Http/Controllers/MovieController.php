<?php

namespace App\Http\Controllers;

use App\Services\Movie;
use App\Services\MovieActor;
use App\Services\MovieTag;
use App\Services\MovieWriter;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    public function __construct()
    {

    }

    public static function formError()
    {
        return response()->json([
            'code' => 101,
            'message' => 'form validate failed'
        ]);
    }

    public static function normalResponse($data)
    {
        return response()->json([
            'code' => 0,
            'data' => $data
        ]);
    }

    public function getMovieById(Request $request)
    {
        $id = $request->input('id', false);
        $id_type = $request->input('id_type', false);
        if (!$id || !$id_type)
        {
            return self::formError();
        }

        $movie = null;
        if ($id_type == 'auto_inc')
        {
            $movie = Movie::getMovieById($id);
        }
        elseif ($id_type == 'douban')
        {
            $movie = Movie::getMovieByDoubanId($id);
        }

        return self::normalResponse($movie);
    }

    public function getMovieByCondition(Request $request)
    {
        $title = $request->input('title',null);
        $score_up = $request->input('score_up',null);
        $score_down = $request->input('score_down',null);
        $year_up = $request->input('year_up',null);
        $year_down = $request->input('year_down',null);
        $countries = $request->input('countries',null);
        $languages = $request->input('languages',null);
        $length_up = $request->input('length_up',null);
        $length_down = $request->input('length_down',null);

        $movies = Movie::getByConditions($title,$score_up,$score_down,$year_up,$year_down,$countries,$languages,$length_up,$length_down);

        return self::normalResponse($movies);
    }

    public function getMovieByTag(Request $request)
    {
        $tag = $request->input('tag', false);
        if (!$tag)
        {
            return self::formError();
        }

        $movies = MovieTag::getMovieByTag($tag);

        return self::normalResponse($movies);
    }

    public function getMovieByWriter(Request $request)
    {
        $writer = $request->input('writer', false);
        if (!$writer)
        {
            return self::formError();
        }

        $movies = MovieWriter::getMovieByWriter($writer);

        return self::normalResponse($movies);
    }

    public function getMovieByActor(Request $request)
    {
        $actor = $request->input('actor', false);
        if (!$actor)
        {
            return self::formError();
        }

        $movies = MovieActor::getMovieByActor($actor);

        return self::normalResponse($movies);
    }

    public function getMovieCountByProp(Request $request)
    {
        $prop = $request->input('prop', false);
        if (!$prop)
        {
            return self::formError();
        }
        $info = null;
        if ($prop == 'actor')
            $info = MovieActor::getCount();
        elseif ($prop == 'writer')
            $info = MovieWriter::getCount();
        elseif ($prop == 'tag')
            $info = MovieTag::getCount();

        return self::normalResponse($info);
    }
}
