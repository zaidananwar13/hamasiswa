@extends('template/master')

@section('content')
    <div id="fh5co-blog">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2>Report Thread</h2>
                    <p>Thread terlaporkan: {{ $thread->judul }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <form action="{{ url('/report/thread/banned') }}" method="post">
                      @csrf
                      <input type="hidden" name="thread" value="{{ $thread->id_thread }}">
                        <div class="form-group">
                            <label for="">Ulasan</label>
                            <textarea required name="laporan" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                          <center>
                            <button class="btn btn-primary" type="submit">Report!</button>
                          </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
