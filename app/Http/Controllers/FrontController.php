<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Rating;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {

        $currentDateTime = Carbon::now();

        $articles = Article::where('status',1)
            ->where('publish_date','<=', $currentDateTime)
            ->with('ratings')
            ->get();

        $articles->transform(function ($article) {
            $ratings = $article->ratings;
            $ratingsCount = $ratings->count();
            $ratingsSum = $ratings->sum('value');

            $article->average_rating = ($ratingsCount > 0)
                ? number_format((($ratingsSum / $ratingsCount) * 0.7) + (($ratings->last()->value * 2) / 5 * 0.3), 2)
                : 0;

            return $article;
        });

        $list = $articles->sortByDesc('average_rating');

        return view('front.index', compact('list'));
    }

    public function articleDetail(Article $article)
    {
        $articleID = $article->id;
        $previousArticle = Article::where('id', '<', $articleID)
            ->where('status', 1)
            ->where('publish_date', '<=', now())
            ->orderBy('id', 'desc')
            ->first();

        $nextArticle = Article::where('id', '>', $articleID)
            ->where('status', 1)
            ->where('publish_date', '<=', now())
            ->orderBy('id', 'asc')
            ->first();

        $ratings = Rating::where('article_id', $articleID)->get();
        $ratingsCount = $ratings->count();
        $ratingsSum = $ratings->sum('value');


        $article->average_rating = ($ratingsCount > 0)
            ? number_format((($ratingsSum / $ratingsCount) * 0.7) + (($ratings->last()->value * 2) / 5 * 0.3), 2)
            : 0;

        return view('front.article-detail',compact('article','previousArticle', 'nextArticle'));
    }
    public function rate(Request $request)
    {
        $articleID = $request->articleID;

        $user = auth()->user();
        if ($user) {
            $ratingValue = $request->input('rating');


            $existingRating = Rating::where('user_id', $user->id)
                ->where('article_id', $articleID)
                ->first();

            if ($existingRating) {
                $existingRating->update(['value' => $ratingValue]);
            } else {
                Rating::create([
                    'user_id' => $user->id,
                    'article_id' => $articleID,
                    'value' => $ratingValue,
                ]);
            }

            $ratings = Rating::query()->where('article_id', $articleID)->get();
            $ratingsCount = $ratings->count();
            $ratingsSum = $ratings->sum('value');

            $weightedAverage = (($ratingsSum / $ratingsCount) * 0.7) + ((($ratingValue * 2) / 5) * 0.3);

            return response()->json(['success' => true, 'average_rating' => $weightedAverage]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);

    }

}
