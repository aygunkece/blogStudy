@extends("layouts.front")
@section("css")
@endsection
@section("content")

        <div class="card" style="width: 90%;">
            <img src="{{ isset($article->image) ? asset($article->image ): asset('/assets/front/image/blog.jpeg') }}" class="card-img-top" style="height: 30rem;">
            <div class="card-body">
                <div class="card-info">
                    <h3 class="card-title">{{ $article->title }}</h3>
                    <span class="author-info">Yazar Adı : {{ $article->user->name }}</span>
                    <span class="rating-info" id="ratingStars">Makale Puanı :{{ $article->average_rating }}
    <i class="star fa-solid fa-star text-secondary" data-id="{{ $article->id }}" data-value="1"></i>
    <i class="star fa-solid fa-star text-secondary" data-id="{{ $article->id }}" data-value="2"></i>
    <i class="star fa-solid fa-star text-secondary" data-id="{{ $article->id }}" data-value="3"></i>
    <i class="star fa-solid fa-star text-secondary" data-id="{{ $article->id }}" data-value="4"></i>
    <i class="star fa-solid fa-star text-secondary" data-id="{{ $article->id }}" data-value="5"></i>
</span>
                </div>
                <p class="card-text">
                    {!! $article->content !!}
                </p>
            </div>
            <div class="card-footer d-flex justify-content-between">
                    @if ($previousArticle)
                        <a class="btn btn-outline-secondary" href="{{ route('front.article-detail', $previousArticle->id) }}">Önceki Makale</a>
                    @endif


                    @if ($nextArticle)
                        <a class="btn btn-outline-secondary" href="{{ route('front.article-detail', $nextArticle->id) }}">Sonraki Makale</a>
                    @endif

            </div>
        </div>


@endsection
@section("js")
    <script>
        $(document).ready(function() {
            const stars = $('.star');
            const articleID = {{ $article->id }};
            const articleRating = {{ $article->average_rating }};
            console.log(articleRating);

            function compareRating(rating) {
                if (rating >= 0.5 && rating <= 1.4) {
                    return 1;
                } else if (rating >= 1.5 && rating <= 2.49) {
                    return 2;
                } else if (rating >= 2.5 && rating <= 3.49) {
                    return 3;
                } else if (rating >= 3.5 && rating <= 4.49) {
                    return 4;
                } else if (rating > 4.4) {
                    return 5;
                }
            }

            var result = compareRating(articleRating);
            $('.star').removeClass('text-warning'); // Önce tüm yıldızlardan text-warning sınıfını kaldır
            $('.star:lt(' + result + ')').addClass('text-warning'); // Sonra belirlenen sayıda yıldıza text-warning sınıfını ekle



            stars.on('click', function() {
                let articleID = $(this).data('id');
                const value = $(this).data('value');

                // AJAX ile Laravel controller'ına puanı gönder
                $.ajax({
                    method: 'POST',
                    url: `{{ route('front.rate') }}`,
                    data: {
                        rating : value,
                        articleID: articleID,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // Başarılı işlem durumu
                        console.log(response);

                        // Burada gerekli güncellemeleri yapabilirsiniz, örneğin yıldız renklerini değiştirmek
                        stars.each(function() {
                            const sValue = $(this).data('value');
                            if (sValue <= value) {
                                $(this).removeClass('text-secondary').addClass('text-warning');
                            } else {
                                $(this).removeClass('text-warning').addClass('text-secondary');
                            }
                        });
                    },
                    error: function(error) {
                        // Hata durumu
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
