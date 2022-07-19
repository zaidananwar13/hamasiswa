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
    <div id="fh5co-content-section" style="padding-top: 10px !important;">
        <div class="container">
            <div class="row row-bottom-padded-md">
                <div class="col-md-8 heading-section animate-box">
                    <h3>{{ $user->nama . '\'s Profile' }}</h3>
                    @if (\Session::has('alert-success'))
                        <div class="alert alert-primary" role="alert">
                            {{ \Session::get('alert-success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img class="profil" src="{{ url('user/' . $user->gambar) }}" alt="user">
                </div>

                <div class="col-md-1"></div>

                <div class="col-md-5">

                    <p> {{ $user->nama }} <br> <span style="color: gray">{{ $user->alamat_email }}</span></p>
                    <blockquote>
                        <p>{!! $user->deskripsi !!}</p>
                    </blockquote>
                </div>
                <div class="col-md-3">
                    <p>
                        @if ($user->jenis_kelamin != 'Wanita')
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-gender-male" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M9.5 2a.5.5 0 0 1 0-1h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V2.707L9.871 6.836a5 5 0 1 1-.707-.707L13.293 2H9.5zM6 6a4 4 0 1 0 0 8 4 4 0 0 0 0-8z" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-gender-female" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 1a4 4 0 1 0 0 8 4 4 0 0 0 0-8zM3 5a5 5 0 1 1 5.5 4.975V12h2a.5.5 0 0 1 0 1h-2v2.5a.5.5 0 0 1-1 0V13h-2a.5.5 0 0 1 0-1h2V9.975A5 5 0 0 1 3 5z" />
                            </svg>
                        @endif
                        {{ ucfirst($user->jenis_kelamin) }}
                    </p>
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-calendar" viewBox="0 0 16 16">
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                        </svg>
                        {{ 'Bergabung Sejak ' . $user->created_at }}
                    </p>
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-x-diamond-fill" viewBox="0 0 16 16">
                            <path
                                d="M9.05.435c-.58-.58-1.52-.58-2.1 0L4.047 3.339 8 7.293l3.954-3.954L9.049.435zm3.61 3.611L8.708 8l3.954 3.954 2.904-2.905c.58-.58.58-1.519 0-2.098l-2.904-2.905zm-.706 8.614L8 8.708l-3.954 3.954 2.905 2.904c.58.58 1.519.58 2.098 0l2.905-2.904zm-8.614-.706L7.292 8 3.339 4.046.435 6.951c-.58.58-.58 1.519 0 2.098l2.904 2.905z" />
                        </svg>
                        {{ ($user->thread != null ? $user->thread : 0) . ' threads.' }}
                    </p>
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-x-diamond" viewBox="0 0 16 16">
                            <path
                                d="M7.987 16a1.526 1.526 0 0 1-1.07-.448L.45 9.082a1.531 1.531 0 0 1 0-2.165L6.917.45a1.531 1.531 0 0 1 2.166 0l6.469 6.468A1.526 1.526 0 0 1 16 8.013a1.526 1.526 0 0 1-.448 1.07l-6.47 6.469A1.526 1.526 0 0 1 7.988 16zM7.639 1.17 4.766 4.044 8 7.278l3.234-3.234L8.361 1.17a.51.51 0 0 0-.722 0zM8.722 8l3.234 3.234 2.873-2.873c.2-.2.2-.523 0-.722l-2.873-2.873L8.722 8zM8 8.722l-3.234 3.234 2.873 2.873c.2.2.523.2.722 0l2.873-2.873L8 8.722zM7.278 8 4.044 4.766 1.17 7.639a.511.511 0 0 0 0 .722l2.874 2.873L7.278 8z" />
                        </svg>
                        {{ ($user->rethread != null ? $user->rethread : 0) . ' re-threads.' }}
                    </p>
                    @if (\Session::get('mail') == $user->alamat_email)
                    <a href="{{ url('profile/edit') }}">
                      <button type="button" class="btn btn-outline-danger"
                          style="width:100%; float: right !important;">Edit Profile</button>
                  </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
