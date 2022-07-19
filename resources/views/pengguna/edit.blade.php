@extends('template/master')
@section('css')
    <style>
        .profil {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background-size: cover;
        }
    </style>
@endsection

@section('content')
    <div id="fh5co-contact" style="padding-top: 0px !important;">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading" style="margin-bottom: 25px !important;">
                    <h2>Edit Profile</h2>
                    <p>Kreasikan Avatar Kamu!</p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12" style="margin-bottom: 50px !important;">
                    <center>
                        <img id="frame" class="profil" src="{{ url('user/' . $user->gambar) }}" alt="user">
                    </center>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-push-1 animate-box">
                    @if (\Session::has('alert-success'))
                        <div style="color: #1A6DBC;" class="alert alert-primary" role="alert">
                            {{ Session::get('alert-success') }}
                        </div>
                    @endif
                    @if (\Session::has('alert'))
                        <div style="color: red;" class="alert alert-primary" role="alert">
                            {{ Session::get('alert') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ url('profil/update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="Image" class="form-label">Profile Picture</label>
                                    <input required name="gambar" class="form-control" type="file" id="formFile"
                                        onchange="preview()">
                                </div>
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input required type="text" name="nama" class="form-control" placeholder="Alamat Email"
                                        value="{{ $user->nama }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea id="editor" required name="deskripsi" class="form-control">{!! $user->deskripsi !!}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input required type="email" name="email" class="form-control" placeholder="Alamat Email"
                                        value="{{ $user->alamat_email }}">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group mt-3 justify-content-center">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);
        }

        function clearImage() {
            document.getElementById('formFile').value = null;
            frame.src = "";
        }
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection