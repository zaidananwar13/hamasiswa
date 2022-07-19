@extends('template/master')

@section('content')
    <div id="fh5co-contact" style="padding-top: 0px !important;">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2>Login</h2>
                    <p>Bergabung dengan komunitas Hamasiswa!</p>
                </div>
            </div>
        </div>

        <!-- password,gambar -->
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-push-1 animate-box">
                    @if (\Session::has('alert-success'))
                        <div style="color: #1A6DBC;" class="alert alert-primary" role="alert">
                            {{ Session::get('alert-success') }}
                        </div>
                    @endif
                    @if(\Session::has('alert'))
                    <div style="color: red;" class="alert alert-primary" role="alert">
                        {{Session::get('alert')}}
                    </div>
                    @endif
                    <form method="POST" action="{{ url('login/proc') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input required type="text" name="email" class="form-control" placeholder="Alamat Email">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input required type="password" name="password" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mt-3 justify-content-center">
                                    <input type="submit" value="Login" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
