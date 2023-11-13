<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ArticleService;
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
        $article = $this->articleService->getAllArticles();

        return response()
            ->json()
            ->setData($article)
            ->setStatusCode(200)
            ->setCharset("utf-8")
            ->header("content-type", "application/json")
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE)
            ->setEncodingOptions(JSON_UNESCAPED_SLASHES);

    }
    public function show(Request $request)
    {
        $article = $this->articleService->getByWithAuth($request->id);

        return response()
            ->json()
            ->setData($article)
            ->setStatusCode(200)
            ->setCharset("utf-8")
            ->header("content-type", "application/json")
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE)
            ->setEncodingOptions(JSON_UNESCAPED_SLASHES);


    }
    public function store(Request $request)
    {
        $data = $request->only(['content','title','image','publish_date','status']);

        if (!is_null($request->file('image')))
        {

        $imageFile = $request->file('image');

        $originalName = $imageFile->getClientOriginalName();

        $fileName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $imageFile->getClientOriginalExtension();

        $folder = 'public/articles'; // Kaydedilecek dizini güncelle

        $imageFile->storeAs($folder, $fileName); // public dizini içinde kaydet

        $data['image'] = 'storage/articles/' . $fileName; // Gösterilecek linki güncelle
        }

        $status = 0;
        if (isset($data['status']) && $data['status'])
        {
            $status = 1;
        }
        $data['status'] = $status;
        $data['user_id'] = Auth::id();

        $result = $this->articleService->create($data);

        return response()
            ->json()
            ->setData($result)
            ->setStatusCode(200)
            ->setCharset("utf-8")
            ->header("content-type", "application/json")
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE)
            ->setEncodingOptions(JSON_UNESCAPED_SLASHES);

    }
    public function update(Request $request)
    {
        $data = $request->only(['content','title','image','publish_date','status']);
        if (!is_null($request->file('image')))
        {
            $imageFile = $request->file('image');
            $originalName = $imageFile->getClientOriginalName();
            $fileName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $imageFile->getClientOriginalExtension();

            $folder = 'public/articles';


            if (file_exists(storage_path("app/{$folder}/" . $fileName))) {
                return redirect()->back()->withErrors([
                    'image' => 'Aynı görsel daha önce yüklenmiştir.'
                ]);
            }

            $imageFile->storeAs($folder, $fileName);

            $data['image'] = 'storage/articles/' . $fileName;
        }
        $status = 0;
        if (isset($data['status']) && $data['status'])
        {
            $status = 1;
        }

        $data['status'] = $status;
        $id = $request->id;

        $article = $this->articleService->getByWithAuth($id);
        $this->articleService->setArticle($article)->update($data);

        $result = $this->articleService->getByWithAuth($id);

        return response()
            ->json()
            ->setData($result)
            ->setStatusCode(200)
            ->setCharset("utf-8")
            ->header("content-type", "application/json")
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE)
            ->setEncodingOptions(JSON_UNESCAPED_SLASHES);

    }
    public function status(Request $request)
    {
        $id = $request->id;
        $article = $this->articleService->getByWithAuth($id);

        $this->articleService->setArticle($article)->changeStatus($request->status);

        $result['data'] = $this->articleService->getByWithAuth($id);
        $result['status'] = "Başarılı";
        $result['message'] = "Durum güncellendi";

        return response()
            ->json()
            ->setData($result)
            ->setStatusCode(200)
            ->setCharset("utf-8")
            ->header("content-type", "application/json")
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE)
            ->setEncodingOptions(JSON_UNESCAPED_SLASHES);
    }
    public function delete(Request $request)
    {
        $this->articleService->delete($request->id);

        return response()
            ->json()
            ->setData(['message' => 'Makale Silindi.','status' => 'Başarılı'])
            ->setStatusCode(200)
            ->setCharset("utf-8")
            ->header("content-type", "application/json")
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE)
            ->setEncodingOptions(JSON_UNESCAPED_SLASHES);
    }
}
