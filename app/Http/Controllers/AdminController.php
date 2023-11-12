<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleStoreRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return view('article.list', compact('articles'));
    }

    public function create()
    {
        return view('article.create-update');
    }

    public function edit(Article $article)
    {

        return view("article.create-update", compact("article"));

    }

    public function update(Request $request)
    {
        $data = $request->except("_token");
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
        if (isset($data['status']))
        {
            $status = 1;
        }
        $data['status'] = $status;

        if (auth()->user()->hasRole('admin')) {
            $data['user_id'] = auth()->user()->id;
        }

        Article::query()
            ->where('id',$request->article)
            ->update($data);

        return redirect()->route('admin.index');
    }

    public function destroy(Request $request)
    {
        $articleID = $request->articleID;

        $article = Article::query()
            ->where("id", $articleID)
            ->first();
        if ($article)
        {
            $article->delete();
            return response()
                ->json(['status' => "success", "message" => "Başarılı", "data" => "" ])
                ->setStatusCode(200);
        }
        return response()
            ->json(['status' => "error", "message" => "Makale bulunamadı" ])
            ->setStatusCode(404);
    }

    public function changeStatus(Request $request): \Illuminate\Http\JsonResponse
    {
        $articleID = $request->articleID;

        $article = Article::query()
            ->where("id", $articleID)
            ->first();

        if ($article)
        {
            $article->status = $article->status ? 0 : 1;
            $article->save();

            return response()
                ->json(['status' => "success", "message" => "Başarılı", "data" => $article, "article_status" => $article->status ])
                ->setStatusCode(200);
        }

        return response()
            ->json(['status' => "error", "message" => "Makale bulunamadı" ])
            ->setStatusCode(404);
    }

}
