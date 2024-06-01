@extends('user.layouts.header-nav')
@section('title', 'All Tutors')
@section('main')
   

    <section class="teachers">
        @if ($errors->any())
        <div class="alert alert-warning">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
            <button type="button" class="closebtn" data-bs-dismiss="alert" onclick="this.parentElement.style.display='none';"
                aria-label="Close">X</button>
        </div>
    @endif

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
            <button type="button" class="closebtn" data-bs-dismiss="alert" onclick="this.parentElement.style.display='none';"
                aria-label="Close">X</button>
        </div>
    @endif
        <h1 class="heading">expert tutors</h1>

        <form action="{{ '/tutors/search' }}" method="post" class="search-tutor">
            @csrf
            <input type="text" name="search_tutor" maxlength="100" placeholder="search tutor..." required>
            <button type="submit" name="search_tutor_btn" class="fas fa-search"></button>
        </form>

        <div class="box-container">
            @if (Auth::check())
                @php
                    $tutor_check = DB::table('users')
                        ->where('id', Auth::user()->id)
                        ->where('user_type', '1')
                        ->count();
                @endphp
            @endif

            @if (Auth::check() && $tutor_check != 1)
                <div class="box offer">
                    <h3>Become a tutor</h3>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laborum, magnam!</p>
                    <a href="{{ '/tutors/register' }}" class="inline-btn">get started</a>
                </div>
            @elseif(Auth::check() && $tutor_check == 1)
                <div class="box" style="background-color:#2c3e50; box-shadow: 8px 8px 15px #8e44ad;">
                    <div class="tutor">
                        <img src="{{ asset('/Profile/' . Auth::user()->profile) }}" alt="">
                        <div>
                            <h3 style="color: #fff; font-weight: 700">{{ Auth::user()->name }}</h3>
                            <span style="color:#f39c12; font-weight: 700">{{ Auth::user()->profession }}</span>
                        </div>
                    </div>

                    @php
                        $likes = DB::table('likes')
                            ->where('tutor_id', Auth::user()->id)
                            ->count();
                        $comments = DB::table('comments')
                            ->where('tutor_id', Auth::user()->id)
                            ->count();
                        $playlist = DB::table('playlists')
                            ->where('tutor_id', Auth::user()->id)
                            ->count();
                        $videos = DB::table('contents')
                            ->where('tutor_id', Auth::user()->id)
                            ->count();
                    @endphp

                    <p style="color: #fff; font-weight: 700">playlists : <span
                            style="color: #f39c12">{{ $playlist }}</span></p>
                    <p style="color: #fff; font-weight: 700">total videos : <span
                            style="color: #f39c12">{{ $videos }}</span></p>
                    <p style="color: #fff; font-weight: 700">total likes : <span
                            style="color: #f39c12">{{ $likes }}</span></p>
                    <p style="color: #fff; font-weight: 700">total comments : <span
                            style="color: #f39c12">{{ $comments }}</span></p>
                    <form action="{{ route('tutors-profile', Auth::user()->slug) }}" method="post">
                        @csrf
                        <input type="hidden" name="tutor_email" value="{{ Auth::user()->email }}">
                        <input type="submit" value="view profile" name="tutor_fetch" class="inline-btn">
                    </form>
                </div>
            @else
                <div class="box offer">
                    <h3>Become a tutor</h3>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laborum, magnam!</p>
                    <a href="/login" class="inline-btn">Login To Start</a>
                </div>
            @endif


            @if (!empty($tutors))
                @foreach ($tutors as $tutor)
                    
                        <div class="box">
                            <div class="tutor">
                                <img src="{{ asset('/Profile/' . $tutor->profile) }}" alt="">
                                <div>
                                    <h3>{{ $tutor->name }}</h3>
                                    <span>{{ $tutor->profession }}</span>
                                </div>
                            </div>

                            @php
                                $likes = DB::table('likes')
                                    ->where('tutor_id', $tutor->id)
                                    ->count();
                                $comments = DB::table('comments')
                                    ->where('tutor_id', $tutor->id)
                                    ->count();
                                $playlist = DB::table('playlists')
                                    ->where('tutor_id', $tutor->id)
                                    ->count();
                                $videos = DB::table('contents')
                                    ->where('tutor_id', $tutor->id)
                                    ->count();
                            @endphp

                            <p>playlists : <span>{{ $playlist }}</span></p>
                            <p>total videos : <span>{{ $videos }}</span></p>
                            <p>total likes : <span>{{ $likes }}</span></p>
                            <p>total comments : <span>{{ $comments }}</span></p>
                            <form action="{{ route('tutors-profile', $tutor->slug) }}" method="get">
                                @csrf
                                <input type="hidden" name="tutor_email" value="{{ $tutor->email }}">
                                <input type="submit" value="view profile" name="tutor_fetch" class="inline-btn">
                            </form>
                        </div>
                   
                @endforeach
            @else
                <p class="empty">no tutors found!</p>
            @endif
        </div>
    </section>
@endsection
