@extends("layouts.admin")
@section("css")
@endsection
@section("content")
    @role('admin')
    <div class="card">
        <div class="card-title p-3">Makale Güncelle</div>
        <div class="card-body">
            <form action="{{ route('admin.article.edit',['article' => $article]) }}" method="POST" enctype="multipart/form-data" id="articleForm">
                @csrf
                <label for="title" class="form-label m-t-sm">Makale Başlığı</label>
                <input type="text"
                       id="title"
                       name="title"
                       class="form-control form-control-solid-bordered m-b-sm"

                       placeholder="Makale Başlığı" value="{{ isset($article) ? $article->title : "" }}
                      ">
                <label for="summernote" class="form-label">İçerik</label>
                <textarea
                    name="content" id="content" class="m-b-sm">{!!   isset($article) ? $article->content : "" !!}</textarea>
                <label for="image" class="form-label m-t-sm">Makale Görseli</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/png, image/jpeg, image/jpg" value="{{isset($article) ? $article->image : "" }}">
                @if(isset($article) && $article->image)
                    <img src="{{ asset($article->image) }}" alt="..." class="img-thumbnail @if($article->image) ? '' : 'd-none' @endif" style="width: 200px; height: 150px;" id="selectedImage"><br>
                @endif
                <img src="" alt="..." class="img-thumbnail d-none" id="selectedImage">
                <div class="form-text m-b-sm">Makale Görseli Maksimum 2mb olmalıdır</div>
                <label for="publish_date" class="form-label m-t-sm">Yayınlanma Tarihi</label>
                <input class="form-control"
                       id="publishDate"
                       name="publish_date"
                       type="text"
                       value="{{ isset($article) ? $article->publish_date : "" }}"
                       placeholder="Ne zaman yayınlansın?">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="status" value="1" id="status" {{ isset($article) && $article->status  ? "checked" : "" }}>
                    <label class="form-check-label" for="status">
                        Makale Sitede Aktif Olarak Görünsün mü?
                    </label>
                </div>
                <div class="col-6 mx-auto mt-2">
                    <button type="button" class="btn btn-success btn-rounded w-100" id="btnSave">
                        {{ isset($article) ? "Güncelle" : "Kaydet" }}
                    </button>
                </div>

            </form>
        </div>
    </div>
    @endrole
    @role('writer')
    <div class="card">
        <div class="card-title p-3">Makale {{ isset($article) ? "Güncelle" : "Ekle" }}</div>
        <div class="card-body">
            <form action="{{ isset($article) ? route('article.edit', ['article' => $article]) : route('article.create') }}" method="POST" enctype="multipart/form-data" id="articleForm">
                @csrf
                <label for="title" class="form-label m-t-sm">Makale Başlığı</label>
                <input type="text"
                       id="title"
                       name="title"
                       class="form-control form-control-solid-bordered m-b-sm"

                       placeholder="Makale Başlığı" value="{{ isset($article) ? $article->title : "" }}
                      ">
                <label for="summernote" class="form-label">İçerik</label>
                <textarea
                    name="content" id="content" class="m-b-sm">{!!   isset($article) ? $article->content : "" !!}</textarea>
                <label for="image" class="form-label m-t-sm">Makale Görseli</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/png, image/jpeg, image/jpg" value="{{isset($article) ? $article->image : "" }}">
                @if(isset($article) && $article->image)
                    <img src="{{ asset($article->image) }}" alt="..." class="img-thumbnail @if($article->image) ? '' : 'd-none' @endif" style="width: 200px; height: 150px;" id="selectedImage"><br>
                @endif
                <img src="" alt="..." class="img-thumbnail d-none" id="selectedImage">
                <div class="form-text m-b-sm">Makale Görseli Maksimum 2mb olmalıdır</div>
                <label for="publish_date" class="form-label m-t-sm">Yayınlanma Tarihi</label>
                <input class="form-control"
                       id="publishDate"
                       name="publish_date"
                       type="text"
                       value="{{ isset($article) ? $article->publish_date : "" }}"
                       placeholder="Ne zaman yayınlansın?">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="status" value="1" id="status" {{ isset($article) && $article->status  ? "checked" : "" }}>
                    <label class="form-check-label" for="status">
                        Makale Sitede Aktif Olarak Görünsün mü?
                    </label>
                </div>
                <div class="col-6 mx-auto mt-2">
                    <button type="button" class="btn btn-success btn-rounded w-100" id="btnSave">
                        {{ isset($article) ? "Güncelle" : "Kaydet" }}
                    </button>
                </div>

            </form>
        </div>
    </div>
    @endrole

@endsection
@section("js")
<script>
    $(document).ready(function () {

        @role('writer')
            $('#content').summernote();
        $('#image').on('change', function () {
            var input = this;
            var img = $('#selectedImage');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    img.attr('src', e.target.result);
                    img.css({'width': '200px', 'height': '150px'});
                    img.removeClass('d-none');
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
        $('#btnSave').click(function () {
            var title = $('#title');
            var content = $('#content');
            var publishDate = $('#publishDate');
            var photoType = $('#image')[0].files.length > 0 ? $('#image')[0].files[0].type.toLowerCase() : $('#selectedImage').attr('src').split(';')[0].split(':')[1];

            var allowedPic = [
                'image/jpeg',
                'image/png',
                'image/jpg'
            ];

            if(title.val().trim() === "" || title.val().trim() == null)
            {
                alert("Başlık alanı boş geçilemez.");
            }
            else if(content.val().trim() === "" || content.val().trim() == null)
            {
                alert("İçerik alanı boş geçilemez.");
            }
            /*else if($('#image')[0].files.length<1 || $('#selectedImage')[0].src == null)
            {
                alert("Görsel alanı boş geçilemez.");
            }
            else if(!allowedPic.includes(photoType) || $('#selectedImage')[0].src == null)
            {
                alert("JPEG veya PNG dışındaki dosya türleri yüklenemez.");
            }
            else if($('#image')[0].files.length > 0 && $('#image')[0].files[0].size > 2048)
            {
                alert("2 Mb'den fazla görsel yüklenemez.");
            }*/
            else if(publishDate.val().trim() === "" || publishDate.val().trim() == null)
            {
                alert("Yayınlanma tarihi alanı boş geçilemez.");
            }
            else
            {
                $("#articleForm").submit();
            }
        });
        @endrole
        @role('admin')
            $('#content').summernote();
        $('#image').on('change', function () {
            var input = this;
            var img = $('#selectedImage');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    img.attr('src', e.target.result);
                    img.css({'width': '200px', 'height': '150px'});
                    img.removeClass('d-none');
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
        $('#btnSave').click(function () {
            var title = $('#title');
            var content = $('#content');
            var publishDate = $('#publishDate');
            var photoType = $('#image')[0].files.length > 0 ? $('#image')[0].files[0].type.toLowerCase() : $('#selectedImage').attr('src').split(';')[0].split(':')[1];

            var allowedPic = [
                'image/jpeg',
                'image/png',
                'image/jpg'
            ];

            if(title.val().trim() === "" || title.val().trim() == null)
            {
                alert("Başlık alanı boş geçilemez.");
            }
            else if(content.val().trim() === "" || content.val().trim() == null)
            {
                alert("İçerik alanı boş geçilemez.");
            }
            /*else if($('#image')[0].files.length<1 || $('#selectedImage')[0].src == null)
            {
                alert("Görsel alanı boş geçilemez.");
            }
            else if(!allowedPic.includes(photoType) || $('#selectedImage')[0].src == null)
            {
                alert("JPEG veya PNG dışındaki dosya türleri yüklenemez.");
            }
            else if($('#image')[0].files.length > 0 && $('#image')[0].files[0].size > 2048)
            {
                alert("2 Mb'den fazla görsel yüklenemez.");
            }*/
            else if(publishDate.val().trim() === "" || publishDate.val().trim() == null)
            {
                alert("Yayınlanma tarihi alanı boş geçilemez.");
            }
            else
            {
                $("#articleForm").submit();
            }
        });
        @endrole


    });

</script>
@endsection
