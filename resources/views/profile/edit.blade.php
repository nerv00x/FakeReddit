@extends('layouts.app')

@section('content')
    <form action="/profile/store" method="POST" id="updateImage" enctype="multipart/form-data">
        @csrf
        <input type="file" name="imageUpload" class="form-control" />
        <input type="submit" value="Subir imagen" class="">
    </form>
@endsection
