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
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                    <th scope="col">İşlemler</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>
                        <div class="d-flex">
                            <a href="#"
                               class="btn btn-warning btn-sm">
                                <i class="material-icons ms-0">edit</i>
                            </a>
                            <a href="javascript:void(0)"
                               class="btn btn-danger btn-sm btnDelete"
                               data-name="article_title"
                               data-id="{article_id">
                                <i class="material-icons ms-0">delete</i>
                            </a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section("js")
@endsection
