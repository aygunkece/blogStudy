@extends("layouts.admin")
@section("css")
@endsection
@section("content")
    <div class="card">
        <div class="card-title p-3">Makale {{ isset($article) ? "Güncelle" : "Ekle" }}</div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data" id="articleForm">
                @csrf
                <label for="title" class="form-label m-t-sm">Makale Başlığı</label>
                <input type="text" id="title" name="title" class="form-control form-control-solid-bordered m-b-sm" placeholder="Makale Başlığı">
                <label for="summernote" class="form-label">İçerik</label>
                <textarea name="content" id="content" class="m-b-sm"></textarea>
                <label for="image" class="form-label m-t-sm">Makale Görseli</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/png, image/jpeg, image/jpg">
                <div class="form-text m-b-sm">Makale Görseli Maksimum 2mb olmalıdır</div>
                <label for="publish_date" class="form-label m-t-sm">Yayınlanma Tarihi</label>
                <input class="form-control"
                       id="publishDate"
                       name="publish_date"
                       type="text"
                       value=""
                       placeholder="Ne zaman yayınlansın?">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="status" value="1" id="status">
                    <label class="form-check-label" for="status">
                        Makale Sitede Aktif Olarak Görünsün mü?
                    </label>
                </div>
                <div class="col-6 mx-auto mt-2">
                    <button type="button" class="btn btn-success btn-rounded w-100" id="btnSave">
                        Kaydet
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
@section("js")
<script>
    $(document).ready(function () {
       $('#content').summernote();

        $('#btnSave').click(function () {

            var title = $('#title');
            var content = $('#content');
            var publishDate = $('#publishDate');
            var photoType = $('#image')[0].files[0].type;
            photoType = photoType.toLowerCase();
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
            else if($('#image')[0].files.length<1)
            {
                alert("Görsel alanı boş geçilemez.");
            }
            else if(!allowedPic.includes(photoType))
            {
                alert("JPEG veya PNG dışındaki dosya türleri yüklenemez.");
            }
            else if($('#image')[0].files.length>1 && $('#image')[0].files[0].size > 2048)
            {
                alert("2 Mb'den fazla görsel yüklenemez.");
            }
            else if(publishDate.val().trim() === "" || publishDate.val().trim() == null)
            {
                alert("Yayınlanma tarihi alanı boş geçilemez.");
            }
            else
            {
                $("#articleForm").submit();
            }
        });
    });

</script>
@endsection
