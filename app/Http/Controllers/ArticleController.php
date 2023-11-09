<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleStoreRequest;
use App\Models\Article;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $authUser = \Auth::user();
        $articlesQuery = Article::query();

        if (!$authUser->hasRole('admin'))
        {
            $articlesQuery = $articlesQuery->where('user_id',$authUser->id);
        }
       $articles = $articlesQuery->get();
        return view('article.list', compact('articles'));

    }
    public function create()
    {
        return view('writer.article.create-update');
    }

    public function store(ArticleStoreRequest $request)
    {
        $data = $request->only(['content','title','publish_date']);
        //$data['image'] = $pathImage;
        //$data['publish_date'] = Carbon::parse($data['publish_date'])->timestamp();

        $data['user_id'] = \Auth::user()->id;
        Article::create($data);
        return redirect()->route('article.index');
    }

    public function edit(Article $article)
    {
        dd($article);
    }

    public function update(Request $request)
    {
        //$data verisi hazırla
        Article::query()
            ->where('id',$request->article)
            ->update($data);
        return redirect()->route('article.index');
    }
}
