<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Rating;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
     $list = Article::all();

        return view('front.index', compact('list'));
    }

    public function articleDetail(Article $article)
    {
        $articleID = $article->id;

        // Makalenin ortalama puanını hesapla
        $ratings = Rating::where('article_id', $articleID)->get();
        $ratingsCount = $ratings->count();
        $ratingsSum = $ratings->sum('value');


        $article->average_rating = ($ratingsCount > 0)
            ? number_format((($ratingsSum / $ratingsCount) * 0.7) + (($ratings->last()->value * 2) / 5 * 0.3), 2)
            : 0;

        return view('front.article-detail',compact('article'));
    }

    public function rate(Request $request)
    {
        $articleID = $request->articleID;

        $user = auth()->user();
        if ($user) {
            $ratingValue = $request->input('rating');

            // Kullanıcı daha önce bu makaleye puan vermiş mi kontrol et
            $existingRating = Rating::where('user_id', $user->id)
                ->where('article_id', $articleID)
                ->first();

            if ($existingRating) {
                // Kullanıcı daha önce puan verdiyse güncelle
                $existingRating->update(['value' => $ratingValue]);
            } else {
                // Yeni puan ekle
                Rating::create([
                    'user_id' => $user->id,
                    'article_id' => $articleID,
                    'value' => $ratingValue,
                ]);
            }
            // Puanlama algoritması: Oyların son %30'u kalan %70'e göre 2 kat daha etkili
            $ratings = Rating::query()->where('article_id', $articleID)->get();
            $ratingsCount = $ratings->count();
            $ratingsSum = $ratings->sum('value');

            $weightedAverage = (($ratingsSum / $ratingsCount) * 0.7) + ((($ratingValue * 2) / 5) * 0.3);

            return response()->json(['success' => true, 'average_rating' => $weightedAverage]);
        }

        // Kullanıcı oturum açmamışsa
        return response()->json(['error' => 'Unauthorized'], 401);

    }
}
