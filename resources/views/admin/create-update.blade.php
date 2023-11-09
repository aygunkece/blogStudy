@extends("layouts.admin")
@section("css")
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection

@section("content")
    <div class="card">
        <div class="card-title p-3">Makale Ekle & Güncelle</div>
        <div class="card-body">
            <form action="">
                <input type="text" class="form-control form-control-solid-bordered m-b-sm" placeholder="Makale Başlığı">
                <textarea id="summernote" name="editordata"></textarea>
                <button>Oluştur</button>
            </form>
        </div>
    </div>
@endsection
@section("js")
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection
