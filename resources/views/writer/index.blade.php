@extends("layouts.admin")
@section("css")
@endsection
@section("content")
<h5 class="">Merhaba Sayın {{ Auth::user()->name }} </h5>
    <p> Sol taraftaki menüden makale ekleme ve listeleme işlemlerini yapabilirsiniz.</p>
@endsection

@section("js")
@endsection
