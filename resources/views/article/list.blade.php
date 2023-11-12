@extends("layouts.admin")
@section("css")
@endsection

@section("content")
    <div class="card">
        <div class="card-title p-3">Makale Listesi</div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Status</th>
                    <th scope="col">Writer</th>
                    <th scope="col">Publish Time</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @role('admin')
                @foreach($articles as $article)
                <tr id="row-{{ $article->id }}">
                    <td>
                        @if(!empty($article->image))
                            <img src="{{ asset($article->image) }}" width="100px" class="img-fluid">
                        @endif
                    </td>
                    <td>{{ $article->title }}</td>
                    <td>
                                <span data-bs-container="body" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ substr( $article->content , 0, 200) }}">
                                    {{substr( $article->content , 0 , 20)}}
                                </span>
                    </td>
                    <td>
                        @if($article->status)
                            <a href="javascript:void(0)" class="btn btn-success btn-sm btnChangeStatus" data-id="{{ $article->id }}">Aktif</a>
                        @else
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm btnChangeStatus" data-id="{{ $article->id }}">Pasif</a>
                        @endif
                    </td>
                    <td>{{ $article->user->name }}</td>
                    <td> {{ $article->publish_date }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route("admin.article.edit", ['article' => $article]) }}"
                               class="btn btn-warning btn-sm">
                                <i class="material-icons ms-0">edit</i>
                            </a>
                            <a href="javascript:void(0)"
                               class="btn btn-danger btn-sm btnDelete"
                               data-name="{{ $article->title }}"
                               data-id="{{ $article->id }}">
                                <i class="material-icons ms-0">delete</i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endrole
                @role('writer')
                @foreach($articles as $article)
                <tr id="row-{{ $article->id }}">
                    <td>
                        @if(!empty($article->image))
                            <img src="{{ asset($article->image) }}" width="100px" class="img-fluid">
                        @endif
                    </td>
                    <td>{{ $article->title }}</td>
                    <td>
                                <span data-bs-container="body" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ substr( $article->content , 0, 200) }}">
                                    {{substr( $article->content , 0 , 20)}}
                                </span>
                    </td>
                    <td>
                        @if($article->status)
                            <a href="javascript:void(0)" class="btn btn-success btn-sm btnChangeStatus" data-id="{{ $article->id }}">Aktif</a>
                        @else
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm btnChangeStatus" data-id="{{ $article->id }}">Pasif</a>
                        @endif
                    </td>
                    <td>{{ $article->user->name }}</td>
                    <td> {{ $article->publish_date }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route("article.edit", ['article' => $article]) }}"
                               class="btn btn-warning btn-sm">
                                <i class="material-icons ms-0">edit</i>
                            </a>
                            <a href="javascript:void(0)"
                               class="btn btn-danger btn-sm btnDelete"
                               data-name="{{ $article->title }}"
                               data-id="{{ $article->id }}">
                                <i class="material-icons ms-0">delete</i>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endrole
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section("js")
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            @role('writer')
            $('.btnChangeStatus').click(function () {
                let articleID = $(this).data('id');
                let self = $(this);
                if (confirm('Bu makalenin durumunu değiştirmek istediğinizden emin misiniz?')) {
                    $.ajax({
                        method: "POST",
                        url: "{{ route('article.changeStatus') }}",
                        data: {
                            articleID : articleID,
                            "_token": "{{ csrf_token() }}"
                        },
                        async:false,
                        success: function (data) {
                            if(data.article_status)
                            {
                                self.removeClass("btn-danger");
                                self.addClass("btn-success");
                                self.text("Aktif");
                            }
                            else
                            {
                                self.removeClass("btn-success");
                                self.addClass("btn-danger");
                                self.text("Pasif");
                            }

                            Swal.fire({
                                title: "Başarılı",
                                text: "Status Güncellendi",
                                confirmButtonText: 'Tamam',
                                icon: "success"
                            });
                        },
                        error: function (){
                            console.log("hata geldi");
                        }
                    })
                    console.log('Evet');
                } else {
                    alert("Herhangi bir işlem yapılmadı.")
                    console.log('Hayır.');
                }
            });


            $('.btnDelete').click(function () {
                let articleID = $(this).data('id');
                if (confirm('Bu makaleyi silmek istediğinizden emin misiniz?')) {
                    $.ajax({
                        method: "POST",
                        url: "{{ route('article.destroy') }}",
                        data: {
                            "_method": "DELETE",
                            articleID : articleID,
                            "_token": "{{ csrf_token() }}"
                        },
                        async:false,
                        success: function (data) {

                            $('#row-' + articleID).remove();
                            alert("Makale başarılı bir şekilde silindi.");
                        },
                        error: function (){
                            console.log("hata geldi");
                        }
                    })
                    console.log('Evet');
                } else {
                    alert("Herhangi bir işlem yapılmadı.")
                    console.log('Hayır.');
                }
                });
            @endrole
            @role('admin')
            $('.btnChangeStatus').click(function () {
                let articleID = $(this).data('id');
                let self = $(this);
                if (confirm('Bu makalenin durumunu değiştirmek istediğinizden emin misiniz?')) {
                    $.ajax({
                        method: "POST",
                        url: "{{ route('admin.article.changeStatus') }}",
                        data: {
                            articleID : articleID,
                            "_token": "{{ csrf_token() }}"
                        },
                        async:false,
                        success: function (data) {
                            if(data.article_status)
                            {
                                self.removeClass("btn-danger");
                                self.addClass("btn-success");
                                self.text("Aktif");
                            }
                            else
                            {
                                self.removeClass("btn-success");
                                self.addClass("btn-danger");
                                self.text("Pasif");
                            }

                            Swal.fire({
                                title: "Başarılı",
                                text: "Status Güncellendi",
                                confirmButtonText: 'Tamam',
                                icon: "success"
                            });
                        },
                        error: function (){
                            console.log("hata geldi");
                        }
                    })
                    console.log('Evet');
                } else {
                    alert("Herhangi bir işlem yapılmadı.")
                    console.log('Hayır.');
                }
            });


            $('.btnDelete').click(function () {
                let articleID = $(this).data('id');
                if (confirm('Bu makaleyi silmek istediğinizden emin misiniz?')) {
                    $.ajax({
                        method: "POST",
                        url: "{{ route('admin.article.destroy') }}",
                        data: {
                            "_method": "DELETE",
                            articleID : articleID,
                            "_token": "{{ csrf_token() }}"
                        },
                        async:false,
                        success: function (data) {

                            $('#row-' + articleID).remove();
                            alert("Makale başarılı bir şekilde silindi.");
                        },
                        error: function (){
                            console.log("hata geldi");
                        }
                    })
                    console.log('Evet');
                } else {
                    alert("Herhangi bir işlem yapılmadı.")
                    console.log('Hayır.');
                }
            });
            @endrole

        });
    </script>
@endsection
