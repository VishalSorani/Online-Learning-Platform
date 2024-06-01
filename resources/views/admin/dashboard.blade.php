@extends('admin.layouts.header-nav')
@section('title', 'Welcome To Dashboard')
@section('content')
    <section class="dashboard">

        @if (session('error'))
            <div class="alert alert-warning">
                {{ session('error') }}
                <button type="button" class="closebtn" data-bs-dismiss="alert"
                    onclick="this.parentElement.style.display='none';" aria-label="Close">X</button>
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
                <button type="button" class="closebtn" data-bs-dismiss="alert"
                    onclick="this.parentElement.style.display='none';" aria-label="Close">X</button>
            </div>
        @endif
        <h1 class="heading">dashboard</h1>

        <div class="box-container">

            <div class="box">
                <h3>welcome!</h3>
                <p>{{ auth()->user()->name }}</p>
                <a href="{{ '/admin/view-profile/' . auth()->user()->id }}" class="btn">view profile</a>
            </div>

            <div class="box">
                @php
                    $count_content = DB::table('contents')
                        ->where('tutor_id', auth()->user()->id)
                        ->count();
                @endphp
                <h3>{{ $count_content }}</h3>
                <p>total contents</p>
                <a href="/admin/playlist/add-content" class="btn">add new content</a>
            </div>

            <div class="box">
                @php
                    $count_playlist = DB::table('playlists')
                        ->where('tutor_id', auth()->user()->id)
                        ->count();
                @endphp
                <h3>{{ $count_playlist }}</h3>
                <p>total playlists</p>
                <a href="/admin/playlist/add-playlist" class="btn">add new playlist</a>
            </div>

            <div class="box">
                @php
                    $count_likes = DB::table('likes')
                        ->where('tutor_id', auth()->user()->id)
                        ->count();
                @endphp
                <h3>{{ $count_likes }}</h3>
                <p>total likes</p>
                <a href="{{ route('likes-admin') }}" class="btn">view contents</a>
            </div>

            <div class="box">
                @php
                    $count_comments = DB::table('comments')
                        ->where('tutor_id', auth()->user()->id)
                        ->count();
                @endphp
                <h3>{{ $count_comments }}</h3>
                <p>total comments</p>
                <a href="{{ route('comment-admin') }}" class="btn">view comments</a>
            </div>

            <div class="box">
                <h3>quick select</h3>
                <p>Announcement</p>
                <div class="flex-btn">
                    <a href="#" class="option-btn">Coming</a>
                    <a href="#" class="option-btn">Soon</a>
                </div>
            </div>

        </div>

    </section>

@endsection
