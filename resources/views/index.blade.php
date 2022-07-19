@extends('template/master')

@section('content')
    <header id="fh5co-header" class="fh5co-cover js-fullheight" role="banner" style="margin-top: 0px !important;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="display-t js-fullheight">
                        <div class="display-tc js-fullheight animate-box" data-animate-effect="fadeIn">
                            <h1>Bergabug Dengan Komunitas Mahasiswa</h1>
                            <h2>Bersama kita cari <a href="#">solusinya!</a></h2>
                            <p>
                                @if (\Session::has('mail'))
                                    <a href="{{ url('beranda') }}" class="btn btn-primary btn-lg btn-learn">Beranda</a>
                                @else
                                    <a href="{{ url('login') }}" class="btn btn-primary btn-lg btn-demo"></i> Login</a>
                                    <a href="{{ url('register') }}" class="btn btn-primary btn-lg btn-learn">Daftar
                                        Akun</a>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="fh5co-blog" style="padding-top: 0px !important;">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2>Recent Thread</h2>
                    <p>Temukan thread popular dengan topik yang cocok buat kamu!</p>
                </div>
            </div>
            <div class="row">
                @foreach ($thread as $t)
                    <div class="col-md-4">
                        <div class="fh5co-blog animate-box">
                            <a href="#" class="blog-bg"
                                style="background-image: url({{ url('air/images/blog-1.jpg') }});"></a>
                            <div class="blog-text">
                                <span class="posted_on">{{ $t->created_at }}</span>
                                <h3><a href="#">{{ $t->judul }}</a></h3>
                                <p>{!! Str::substr($t->konten, 0, 50) . '...' !!}</p>
                                <ul class="stuff">
                                    <li><i class="icon-heart2"></i>{{ $t->likes }}</li>
                                    <li><a href="{{ url('/thread/' . $t->id_thread) }}">Read More<i
                                                class="icon-arrow-right22"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="fh5co-started">
        <div class="overlay"></div>
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2>Report!</h2>
                    <p>Bantu kami mengelola thread yang tidak sesuai dengan norma yang ada!</p>
                    <p><a href="#" class="btn btn-default btn-lg">Make a Report</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
