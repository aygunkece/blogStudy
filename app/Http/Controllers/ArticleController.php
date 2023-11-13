<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleStoreRequest;
use App\Models\Article;
use App\Models\User;
use App\Services\ArticleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function __construct(public ArticleService $articleService)
    {
    }

    public function index()
    {
        $articles = $this->articleService->getAllArticles();
        return view('article.list', compact('articles'));

    }

    public function create()
    {
        return view('article.create-update');
    }

    public function store(ArticleStoreRequest $request)
    {

        $data = $request->only(['content', 'title', 'image', 'publish_date', 'status']);

        if (!is_null($request->file('image'))) {

            $imageFile = $request->file('image');

            $originalName = $imageFile->getClientOriginalName();

            $fileName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $imageFile->getClientOriginalExtension();

            $folder = 'public/articles';

            $imageFile->storeAs($folder, $fileName);

            $data['image'] = 'storage/articles/' . $fileName;
        }


        $data['status'] = !isset($request->status) ? 0 : 1;

        $data['user_id'] = auth()->user()->id;

        $this->articleService->create($data);

        return redirect()->route('writer.index');
    }

    public function edit(Article $article)
    {
        $article = (collect($article));
        $article = $article->where('user_id', Auth::user()->id)->first();

        if (!$article) {
            abort(404);
        }

        return view("article.create-update", compact("article"));

    }

    public function update(Request $request)
    {
        $data = $request->only(['content', 'title', 'image', 'publish_date', 'status']);
        if (!is_null($request->file('image'))) {
            $imageFile = $request->file('image');
            $originalName = $imageFile->getClientOriginalName();
            $fileName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $imageFile->getClientOriginalExtension();

            $folder = 'public/articles'; // Kaydedilecek dizini güncelle


            if (file_exists(storage_path("app/{$folder}/" . $fileName))) {
                return redirect()->back()->withErrors([
                    'image' => 'Aynı görsel daha önce yüklenmiştir.'
                ]);
            }

            $imageFile->storeAs($folder, $fileName); // public dizini içinde kaydet

            $data['image'] = 'storage/articles/' . $fileName; // Gösterilecek linki güncelle
        }
        $status = 0;
        if (isset($data['status'])) {
            $status = 1;
        }
        $data['status'] = $status;

        $article = $this->articleService->getByWithAuth($request->article);
        $this->articleService->setArticle($article)->update($data);


        return redirect()->route('writer.index');
    }

    public function destroy(Request $request)
    {
        $articleID = $request->articleID;

        $this->articleService->delete($articleID);

        return response()
            ->json(['status' => "success", "message" => "Başarılı", "data" => ""])
            ->setStatusCode(200);
    }

    public function changeStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $articleID = $request->articleID;

        $article = $this->articleService->getByWithAuth($articleID);

        $this->articleService->setArticle($article)->changeStatus($request->status);

        $article = $this->articleService->getByWithAuth($articleID);

        return response()
            ->json(['status' => "success", "message" => "Başarılı", "data" => $article, "article_status" => $article->status])
            ->setStatusCode(200);

    }
}
