@extends("layouts.admin")
@section("css")
@endsection
@section("content")
    <div class="card">
        <div class="card-title p-3">Makale Ekle & Güncelle</div>
        <div class="card-body">
            <form action="#">
                @csrf
                <label for="image" class="form-label m-t-sm">Makale Başlığı</label>
                <input type="text" class="form-control form-control-solid-bordered m-b-sm" placeholder="Makale Başlığı"> <label for="publish_date" class="form-label m-t-sm">Yayınlanma Tarihi</label>
                <label for="summernote" class="form-label">İçerik</label>
                <textarea name="body" id="summernote" class="m-b-sm"></textarea>
                <label for="image" class="form-label m-t-sm">Makale Görseli</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/png, image/jpeg, image/jpg">
                <div class="form-text m-b-sm">Makale Görseli Maksimum 2mb olmalıdır</div>

                <input class="form-control"
                       id="publish_date"
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

@endsection
