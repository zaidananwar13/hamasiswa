@extends('template/master2')

@section('content')
    <div id="fh5co-contact">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2>Reports</h2>
                </div>
            </div>
        </div>

        <!-- password,gambar -->
        <div class="container">
            <div class="row">

                @if (\Session::has('alert-success'))
                    <div style="color: #1A6DBC;" class="alert alert-primary" role="alert">
                        {{ Session::get('alert-success') }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Thread</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $index = 0;
                        @endphp
                        @foreach ($reports as $item)
                        @php
                            $index++;
                        @endphp
                            <tr>
                                <th scope="row">{{ $index }}</th>
                                <td>{{ $item->thread->judul }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td><a href="{{ url('dashboard/thread/bann/' . $item->id_thread) }}">Bann!</a></td>
                            </tr>
                        @endforeach
                        @if ($index < 1)
                            <tr>
                              <td colspan="4"><center><h3>No Report Yet</h3></center></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
