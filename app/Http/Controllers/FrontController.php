<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Rating;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class FrontController extends Controller
{
    public function index()
    {
        $cachedArticles = Redis::get('cached_articles');

        if (!$cachedArticles) {
            $currentDateTime = Carbon::now();

            $articles = Article::where('status', 1)
                ->where('publish_date', '<=', $currentDateTime)
                ->with('ratings')
                ->get();

            $articles->transform(function ($article) {

                $ratings = $article->ratings;
                $ratingsCount = $ratings->count();
                $ratingsSum = $ratings->sum('value');
                $reversedRatings = $ratings->reverse();

                $last30PercentCount = ceil(0.3 * $ratingsCount);
                $last30PercentEffect = $reversedRatings->take($last30PercentCount)->sum('value') * 2;
                $totalEffect = (($ratingsSum- $reversedRatings->take($last30PercentCount)->sum('value')) + $last30PercentEffect)/($ratingsCount + $last30PercentCount);
                $article->average_rating = ($ratingsCount > 0)
                    ? number_format($totalEffect, 2)
                    : 0;

                return $article;
            });

            $list = $articles->sortByDesc('average_rating');

            Redis::set('cached_articles', $list->toJson());
            Redis::expire('cached_articles', 300);
        } else {
            $list = json_decode($cachedArticles);
        }

        return view('front.index', compact('list'));
    }


    public function articleDetail(Article $article)
    {
        $cachedArticle = Redis::get('cached_article_' . $article->id);

        if (!$cachedArticle) {

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

            $article->load('user');

            $ratings = Rating::where('article_id', $articleID)->get();
            $ratingsCount = $ratings->count();
            $ratingsSum = $ratings->sum('value');
            $reversedRatings = $ratings->reverse();

            $last30PercentCount = ceil(0.3 * $ratingsCount);
            $last30PercentEffect = $reversedRatings->take($last30PercentCount)->sum('value') * 2;
            $totalEffect = (($ratingsSum- $reversedRatings->take($last30PercentCount)->sum('value')) + $last30PercentEffect)/($ratingsCount + $last30PercentCount);
            $article->average_rating = ($ratingsCount > 0)
                ? number_format($totalEffect, 2)
                : 0;

            Redis::set('cached_article_' . $article->id, $article->toJson());

            Redis::expire('cached_article_' . $article->id, 300);

            $cachedArticle = Redis::get('cached_article_' . $article->id);
        }

        $article = json_decode($cachedArticle);

        $previousArticle = $previousArticle ?? null;
        $nextArticle = $nextArticle ?? null;

        return view('front.article-detail', compact('article', 'previousArticle', 'nextArticle'));
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
            $reversedRatings = $ratings->reverse();

            $last30PercentCount = ceil(0.3 * $ratingsCount);
            $last30PercentEffect = $reversedRatings->take($last30PercentCount)->sum('value') * 2;
            $totalEffect = (($ratingsSum- $reversedRatings->take($last30PercentCount)->sum('value')) + $last30PercentEffect)/($ratingsCount + $last30PercentCount);
            $average_rating = ($ratingsCount > 0)
                ? number_format($totalEffect, 2)
                : 0;

            return response()->json(['success' => true, 'average_rating' => $average_rating]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);

    }

}
