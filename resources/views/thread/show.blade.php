@extends('template/master')
@section('css')
    <style>
        .round-thumb {
            box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, .26) !important;
        }

        .my-2 {
            margin: 8px 0 !important;
        }

        .pt-1 {
            padding-top: 4px !important;
        }

        .like {
            cursor: pointer;
            user-select: none;
            transition: .2s ease-out;
        }

        .like:hover,
        .activate {
            color: #dd356e !important;
        }

        .clicked {
            animation: pop 0.3s linear 1;
        }

        @keyframes pop {
            50% {
                transform: scale(1.2);
            }
        }

        .customTooltip {
            cursor: pointer !important;
            position: relative;
            display: inline-block;
            opacity: 1 !important;
        }

        .customTooltip .customTooltiptext {
            visibility: hidden;
            width: 140px;
            font-size: 14px;
            background-color: #555;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 150%;
            left: 50%;
            margin-left: -75px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .customTooltip .customTooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        .customTooltip:hover .customTooltiptext {
            visibility: visible;
            opacity: 1;
        }

        .animate-box {
            box-shadow: 0px 2px 5px 0px rgba(0, 0, 0, .06) !important;
        }

        .content>* {
            color: black !important;
        }

        .content img {
            max-width: 400px !important;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-6">
            <div class="fh5co-portfolio animate-box">
                <div class="portfolio-text">


                    @if (\Session::has('alert-success'))
                        <div class="alert alert-primary" role="alert">
                            {{ \Session::get('alert-success') }}
                        </div>
                    @endif
                    @if (\Session::has('alert-danger'))
                        <div class="alert alert-danger" role="alert">
                            {{ \Session::get('alert-danger') }}
                        </div>
                    @endif
                    <ul class="stuff" style="border-top: unset !important;">
                        <li>
                            <h3>{{ $thread->judul }}</h3>
                        </li>
                        <li>
                            <div class="dropdown" style="cursor: pointer !important;">
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                    style="z-index: 100000 !important; background-color:white !important;margin-right: 100px !important; position: relative; left: 90px;padding: 10px;">
                                    <ul style="padding: 0px 25px !important; font-size:18px !important;">
                                        <li>&nbsp;</li>
                                        @if ($thread->threadStarter->alamat_email == \Session::get('mail'))
                                            <li
                                                style="display: block !important; padding: 0 !important; margin: 0 !important;">
                                                <a class="dropdown-item"
                                                    href="{{ url('thread/edit/' . $thread->id_thread) }}">
                                                    <i class="icon-edit2"></i> Edit</a>
                                            </li>
                                        @endif
                                        <li style="display: block !important; padding: 0 !important; margin: 0 !important;">
                                            <a class="dropdown-item"
                                                href="{{ url('report/thread/' . $thread->id_thread) }}"><i
                                                    class="icon-flag"></i> Report</a>
                                        </li>
                                        <li style="display: block !important; padding: 0 !important; margin: 0 !important;">
                                            <a class="dropdown-item" href="#"><i class="icon-link"></i> Share</a>
                                        </li>
                                        <li>&nbsp;</li>
                                    </ul>
                                </div>
                                <i class="icon-menu2 dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                            </div>
                        </li>
                    </ul>

                    <div class="content">
                        {!! $thread->konten !!}
                    </div>

                    <ul class="stuff">
                        <li id="threadLike" class="like {{ $thread->liked == true ? 'activate' : '' }}"
                            onclick="like({{ $thread->id_thread }}, 'thread', {{ $thread->liked }})"><i
                                class="icon-heart2"></i>{{ $thread->likes }} likes</li>
                        <li><i class="icon-book"></i>{{ count($thread->subThread != null ? $thread->subThread : []) }}
                            Re-thread</li>
                        {{-- <li><i class="icon-home"></i>Comment</li> --}}
                        <li onclick="copy()" onmouseout="setOut()" class="customTooltip">
                            <span id="mycustomTooltip" class="customTooltiptext">Copy to clipboard</span>
                            <i class="icon-link "></i>Share
                        </li>
                    </ul>
                    <hr>
                    <form method="POST" action="{{ url('/thread/reply/' . $thread->id_thread) }}">
                        @csrf

                        <input type="hidden" name="user" value="{{ \Session::get('mail') }}">
                        <input type="hidden" name="status" value="thread">
                        <div class="row">
                            <div class="my-2 col-md-1">
                                <img class="round-thumb" style="width: 50px; height: 50px;border-radius:50%;"
                                    src="{{ url('user/' . \Session::get('img')) }}" alt="profile-user">
                            </div>

                            <div class="my-2 col-md-9">
                                <div class="form-group">
                                    <textarea id="editor" name="konten" type="text" class="form-control" placeholder="Add Comment"></textarea>
                                </div>
                            </div>

                            <div class="my-2 col-md-2 pt-1">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>

                    <h3>{{ count($thread->subThread != null ? $thread->subThread : []) }} Comments</h3>
                    <hr>
                    @foreach ($thread->subThread as $subThread)
                        <div class="portofolio-text"
                            style="max-width: 100% !important;box-shadow: 0px 3px 3px 0px rgba(0, 0, 0, .06) !important; padding: 20px;">
                            <h3>{{ $subThread->judul }}</h3>

                            <div class="content">
                                <img class="round-thumb"
                                    style="width: 50px; height: 50px;border-radius:50%;margin-right: 15px !important;"
                                    src="{{ url('user/' . $subThread->subThreader->gambar) }}" alt="profile-user">
                                <span>{{ ucfirst($subThread->subThreader->nama) }}</span>
                                <br><br>
                                {!! $subThread->konten !!}
                            </div>

                            <ul class="stuff">
                                {{-- <li class="like"
                                    onclick="like({{ $subThread->id_subThread }}, 'sub_thread', {{ $subThread->liked }})">
                                    <i class="icon-heart2"></i>{{ $subThread->likes }} likes
                                </li>
                                <li><i class="icon-book"></i>248 Re-thread</li> --}}
                                {{-- <li><i class="icon-home"></i>Comment</li> --}}
                                {{-- <li onclick="copy()" onmouseout="setOut()" class="customTooltip">
                                    <span id="mycustomTooltip" class="customTooltiptext">Copy to clipboard</span>
                                    <i class="icon-link "></i>Share
                                </li> --}}
                                <li>&nbsp;</li>

                                <li style="display: block !important; padding: 0 !important; margin: 0 !important;">
                                    <a class="dropdown-item"
                                        href="{{ url('report/subthread/' . $subThread->id_subThread) }}"><i
                                            class="icon-flag"></i> Report</a>
                                </li>
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="fh5co-portfolio animate-box">
                <div class="portfolio-text">
                    <h3>
                        <img class="round-thumb" style="width: 50px; height: 50px;border-radius:50%;"
                            src="{{ url('user/' .  $thread->threadStarter->gambar) }}" alt="profile-user">
                        <span>About {{ $thread->threadStarter->nama }}'s</span>
                    </h3>
                    <hr>
                    <p>
                    <blockquote>
                        {!! $thread->threadStarter->deskripsi !!}
                    </blockquote>
                    </p>
                    <p>
                        <span><i class="icon-flag"></i>{{ $thread->threadStarter->thread }} Threads. </span>
                        <span><i class="icon-history"></i> {{ $thread->threadStarter->subThread }} Re-Threads. </span>
                    </p>
                    <p>Bergabung sejak {{ $thread->threadStarter->created_at }}</p>
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

    <script>
        let copy = () => {
            let link = "{{ URL::current() }}"

            navigator.clipboard.writeText(link);

            let customTooltip = document.getElementById("mycustomTooltip");
            customTooltip.innerHTML = "Copied!!";
        }

        let setOut = () => {
            let customTooltip = document.getElementById("mycustomTooltip");
            customTooltip.innerHTML = "Copy to clipboard";
        }
        let statusA = {{ $thread->status }}

        let like = (id, type, status) => {
            if (statusA == true) {
                statusA = false;

                $("#threadLike").toggleClass("activate");
                $.ajax({
                    type: "GET",
                    url: "/like/" + type,
                    data: {
                        user: `{{ \Session::get('mail') }}`,
                        thread: `{{ $thread->id_thread }}`,
                    },
                    success: function(response) {
                        let temp = `
                            <i class="icon-heart2"></i> ${response["like"]} likes
                        `;

                        $("#threadLike").empty();
                        $("#threadLike").html(temp);
                    }
                });
            } else {
                document.querySelector(".like").className += " clicked activate";
                statusA = true;
                $("#threadLike").toggleClass("activate");
                $.ajax({
                    type: "GET",
                    url: "/unlike/" + type,
                    data: {
                        user: `{{ \Session::get('mail') }}`,
                        thread: `{{ $thread->id_thread }}`,
                    },
                    success: function(response) {
                        let temp = `
                            <i class="icon-heart2"></i> ${response["like"]} likes
                        `;

                        $("#threadLike").empty();
                        $("#threadLike").html(temp);
                    }
                });
            }
        }
    </script>
@endsection
