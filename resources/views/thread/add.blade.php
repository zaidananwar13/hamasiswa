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
                    <h2>Add a Thread</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia.</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-md-push-1 animate-box">
                    <img class="profil" src="{{ url('user/' . \Session::get('img')) }}" alt="user">
                </div>
                <div class="col-md-7 col-md-push-1 animate-box">
                    <form action="{{ url('thread/addpost') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="judul">Any Title?</label>
                            <input required type="text" name="judul" class="form-control" id="judul"
                                aria-describedby="emailHelp" placeholder="Enter title">
                        </div>
                        <div class="form-group">
                            <label for="editor">What's on your mind?</label>
                            <textarea  name="content" class="form-control" id="editor" cols="30" rows="10"
                                placeholder="Type something..."></textarea>
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
