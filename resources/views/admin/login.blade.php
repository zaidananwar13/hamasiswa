@extends('template/master2')

@section('content')
    <div id="fh5co-contact">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2>Login Admin</h2>
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
                    <form method="POST" action="{{ url('dashboard/logPost') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input required type="text" name="username" class="form-control" placeholder="Username">
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
