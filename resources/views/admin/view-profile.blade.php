@extends('admin.layouts.header-nav')
@section('title', 'view-profile')
@section('content')
    <section class="tutor-profile" style="min-height: calc(100vh - 19rem);">


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

        <h1 class="heading">profile details</h1>

        <div class="details">
            <div class="tutor">
                <img src="{{ asset('/Profile/' . Auth()->user()->profile) }}" alt="">
                <h3></h3>
                <span></span>
                <a href="{{ '/admin/update-profile/' . auth()->user()->id }}" class="inline-btn">update profile</a>
            </div>
            <div class="flex">
                <div class="box">
                    @php
                        $count_playlist = DB::table('playlists')
                            ->where('tutor_id', auth()->user()->id)
                            ->count();
                    @endphp
                    <span>{{ $count_playlist }}</span>
                    <p>total playlists</p>
                    <a href="{{ '/admin/playlist' }}" class="btn">view playlists</a>
                </div>

                @php
                    $count_content = DB::table('contents')
                        ->where('tutor_id', auth()->user()->id)
                        ->count();
                @endphp
                <div class="box">
                    <span>{{ $count_content }}</span>
                    <p>total videos</p>
                    <a href="{{ '/admin/playlist/content' }}" class="btn">view contents</a>
                </div>
                <div class="box">
                    @php
                        $count_likes = DB::table('likes')
                            ->where('tutor_id', auth()->user()->id)
                            ->count();
                    @endphp
                    <span>{{ $count_likes }}</span>
                    <p>total likes</p>
                    <a href="{{ route('likes-admin') }}" class="btn">view likes</a>
                </div>
                <div class="box">
                    @php
                        $count_comments = DB::table('comments')
                            ->where('tutor_id', auth()->user()->id)
                            ->count();
                    @endphp
                    <span>{{ $count_comments }}</span>
                    <p>total comments</p>
                    <a href="{{ route('comment-admin') }}" class="btn">view comments</a>
                </div>
            </div>
        </div>

    </section>

@endsection
