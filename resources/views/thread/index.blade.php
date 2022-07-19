@extends('template/master')

@section('content')
    <div id="fh5co-blog mt-2">
        <div class="container">
            <div class="row">
                @if (\Session::has('alert-success'))
                    <div class="alert alert-primary" role="alert">
                        {{ \Session::get('alert-success') }}
                    </div>
                @endif

                @foreach ($thread as $t)
                    <div class="col-md-4">
                        <div class="fh5co-blog animate-box">
                            <a href="#" class="blog-bg"
                                style="background-image: url({{ url('air/images/blog-' . rand(1, 3) . '.jpg') }});"></a>
                            <div class="blog-text">
                                <span class="posted_on">{{ $t->created_at }}</span>
                                <h3><a href="#">{{ $t->judul }}</a></h3>
                                <p>{!! Str::substr($t->konten, 0, 20) . '...' !!}</p>
                                <ul class="stuff">
                                    <li><i class="icon-heart2"></i>{{ $t->likes }}</li>
                                    <li><a href="{{ url('/thread/' . $t->id_thread) }}">Read More
                                            <i class="icon-arrow-right22"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>
        </div>
    </div>
@endsection
