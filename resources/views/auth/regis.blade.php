@extends('template/master')

@section('content')
    <div id="fh5co-contact" style="padding-top: 0px !important;">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2>Daftar</h2>
                    <p>Registrasikan akunmu untuk bergabung dengan komunitas Hamasiswa!</p>
                </div>
            </div>
        </div>

        <!-- password,gambar -->
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-push-1 animate-box">
                    @if(\Session::has('alert'))
                    <div style="color: red;" class="alert alert-primary" role="alert">
                        {{Session::get('alert')}}
                    </div>
                    @endif
                    <form method="POST" action="{{ url('register/proc') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input required type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input required type="text" name="email" class="form-control" placeholder="Alamat Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input required type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input required type="password" name="passwordConf" class="form-control"
                                        placeholder="Password Confirm">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <div class="form-check">
                                        <input required class="form-check-input" value="laki-laki" type="radio"
                                            name="jenis_kelamin" id="jenis_kelamin1">
                                        <label class="form-check-label" for="jenis_kelamin1">
                                            Laki-laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input required class="form-check-input" value="perempuan" type="radio"
                                            name="jenis_kelamin" id="jenis_kelamin2">
                                        <label class="form-check-label" for="jenis_kelamin2">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input required type='date' name='birthday' class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mt-3 justify-content-center">
                                    <input type="submit" value="Daftar" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
