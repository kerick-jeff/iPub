<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Pub;
use App\PubFile;
use App\Rater;
use Illuminate\Http\Request;
use App\Http\Requests;

class PubsController extends Controller
{
    /**
     * show the view of the /pubs page
     * @return View
     */
    public function index(Request $request){
        $pubs = Pub::orderBy('created_at', 'desc')->get();

        $pubEntities = [];
        foreach ($pubs as $pub) {
            $pubFile = PubFile::where('pub_id', $pub->id)->first();
            $author = User::find($pub->user_id);

            // Determine if a visitor in Rating Mode can rate or unrate a pub
            $rate = true;
            if(session('rater')) {
                $pub_rater = DB::table('pub_rater')
                                ->select('pub_id', 'rater_id')
                                ->where('pub_id', $pub->id)
                                ->where('rater_id', Rater::where('email', session('rater'))->value('id'))
                                ->first();
                if($pub_rater) {
                    $rate = false;
                } else {
                    $rate = true;
                }
            }

            $pubEntity = [$pub, $pubFile, $author, $rate];
            array_push($pubEntities, $pubEntity);
        }

        return view('index', ['pubEntities' => $pubEntities, 'categories' => Pub::getCategories()]);
    }

    /**
     * Find all pubs with their associate pub files based on a category criteria
     * @param $categoryName
     * @return View
     */
    public function findByCategory($categoryName) {
        $pubs = Pub::where('category', str_replace('-', '/', $categoryName))->orderBy('created_at', 'desc')->get();

        $pubEntities = [];
        foreach ($pubs as $pub) {
            $pubFile = PubFile::where('pub_id', $pub->id)->first();
            $author = User::find($pub->user_id);

            // Determine if a visitor in Rating Mode can rate or unrate a pub
            $rate = true;
            if(session('rater')) {
                $pub_rater = DB::table('pub_rater')
                                ->select('pub_id', 'rater_id')
                                ->where('pub_id', $pub->id)
                                ->where('rater_id', Rater::where('email', session('rater'))->value('id'))
                                ->first();
                if($pub_rater) {
                    $rate = false;
                } else {
                    $rate = true;
                }
            }

            $pubEntity = [$pub, $pubFile, $author, $rate];
            array_push($pubEntities, $pubEntity);
        }

        return view('index', ['pubEntities' => $pubEntities, 'categories' => Pub::getCategories(), 'activeLi' => str_replace('-', '/', $categoryName)]);
    }

    /**
     * Find all pubs with their associate pub files by the user Id
     * @param $username
     * @param $userId
     * @return View
     */
    public function findByUser($username, $userId) {
        $pubs = Pub::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        $pubEntities = [];
        foreach ($pubs as $pub) {
            $pubFile = PubFile::where('pub_id', $pub->id)->first();
            $author = User::find($pub->user_id);

            // Determine if a visitor in Rating Mode can rate or unrate a pub
            $rate = true;
            if(session('rater')) {
                $pub_rater = DB::table('pub_rater')
                                ->select('pub_id', 'rater_id')
                                ->where('pub_id', $pub->id)
                                ->where('rater_id', Rater::where('email', session('rater'))->value('id'))
                                ->first();
                if($pub_rater) {
                    $rate = false;
                } else {
                    $rate = true;
                }
            }

            $pubEntity = [$pub, $pubFile, $author, $rate];
            array_push($pubEntities, $pubEntity);
        }

        return view('index', ['pubEntities' => $pubEntities, 'categories' => Pub::getCategories()]);
    }

    /**
     * Find pub with its associate pub files by its id
     * @param $id
     * @return View
     */
    public function findById($id) {
        $pub = Pub::find($id);

        $pubEntities = [];
        $pubFile = PubFile::where('pub_id', $pub->id)->first();
        $author = User::find($pub->user_id);

        // Determine if a visitor in Rating Mode can rate or unrate a pub
        $rate = true;
        if(session('rater')) {
            $pub_rater = DB::table('pub_rater')
                            ->select('pub_id', 'rater_id')
                            ->where('pub_id', $pub->id)
                            ->where('rater_id', Rater::where('email', session('rater'))->value('id'))
                            ->first();
            if($pub_rater) {
                $rate = false;
            } else {
                $rate = true;
            }
        }

        $pubEntity = [$pub, $pubFile, $author, $rate];
        array_push($pubEntities, $pubEntity);

        return view('index', ['pubEntities' => $pubEntities, 'categories' => Pub::getCategories()]);
    }
}
