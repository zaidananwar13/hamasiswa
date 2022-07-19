@extends('template/master')
@section('css')
    <style>
        .profil {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background-size: cover;
        }
    </style>
@endsection

@section('content')
    <div id="fh5co-contact py-1">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2>Edit Thread</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-md-push-1 animate-box">
                    <img class="profil" src="{{ url('user/' . \Session::get('img')) }}" alt="user">
                </div>
                <div class="col-md-7 col-md-push-1 animate-box">
                    <form action="{{ url('thread/uppost') }}" method="POST">
                        @csrf
                        <input type="hidden" name="thread" value="{{ $thread->id_thread }}">
                        <div class="form-group">
                            <label for="judul">Any Title?</label>
                            <input required value="{{ $thread->judul }}" type="text" name="judul" class="form-control" id="judul"
                                aria-describedby="emailHelp" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="editor">What's on your mind?</label>
                            <textarea name="content" class="form-control" id="editor" cols="30" rows="10"
                                placeholder="Type something...">{!! $thread->konten !!}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
