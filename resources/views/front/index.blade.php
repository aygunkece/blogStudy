@extends("layouts.front")
@section("css")
@endsection

@section("content")
@foreach($list as $item)
    <div class="card mb-4" style="width: 90%;">
        <img src="{{ isset($item) ? $item->image : asset('/assets/front/image/blog.jpeg') }}" class="card-img-top" style="height: 15rem;">
        <div class="card-body">
            <h5 class="card-title">{{ $item->title }}</h5>
            <p class="card-text">{{ $item->content }}</p>
            <a href="{{ route("front.article-detail", ['article' => $item]) }}" class="btn btn-primary">Makaleyi Oku</a>
        </div>
    </div>
@endforeach




@endsection

@section("js")
@endsection
