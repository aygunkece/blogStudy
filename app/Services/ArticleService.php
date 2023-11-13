<?php

namespace App\Services;

use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ArticleService
{
    public Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function getAllArticles(): \Illuminate\Database\Eloquent\Collection
    {
        $authUser = Auth::user();

        $articlesQuery = Article::query();

        if (!$authUser->hasRole('admin'))
        {
            $articlesQuery = $articlesQuery->where('user_id',$authUser->id);
        }
        return $articlesQuery->with('user')->get();
    }
    public function getById(int $id): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
    {
        return $this->article::query()
            ->where("id", $id)
            ->firstOrFail();
    }
    public function getByWithAuth(int $id)
    {
        $authUser = Auth::user();
        $queryArticle = $this->article::query()->where("id", $id);
        if (!$authUser->hasRole('admin'))
        {
            $queryArticle = $queryArticle->where('user_id', $authUser);

        }
        return $queryArticle->firstOrFail();
    }

    public function create(array $data): Article
    {
        return $this->article::create($data);
    }

    public function update(array $data): bool
    {
        return $this->article->update($data);
    }

    public function changeStatus(int $status): bool
    {
        return $this->article->update(['status' => $status]);
    }

    public function delete(int $id): bool|null
    {
        $article = $this->getByWithAuth($id);
        return $article->delete();

    }

    public function setArticle(Article $article): ArticleService
    {
        $this->article = $article;

        return $this;
    }


}

