@extends('user.layouts.header-nav')
@section('title', 'Enrolled Courses')
@section('main')
    <section class="courses">

        <h1 class="heading">Your Courses</h1>

        <div class="box-container">
            @if (!empty($courses))
                @foreach ($courses as $course)
                    @php
                        $playlist = DB::table('playlists')->where('id',$course->playlist_id)->get();
                        $user = DB::table('users')->where('id',$playlist['0']->tutor_id)->get();
                    @endphp
              
                <div class="box">
                    <div class="tutor">
                        <img src="{{ asset('/Profile/'.$user['0']->profile) }}" alt="">
                        <div>
                            <h3>{{ $user['0']->name }}</h3>
                            <span>{{ date('Y-m-d', strtotime($playlist['0']->created_at)) }}</span>
                        </div>
                    </div>
                    <img src="{{ asset('/Thumbnails/playlist/' . $playlist['0']->thumb) }}" class="thumb" alt="">
                    <h3 class="title">{{ $playlist['0']->title }}</h3>
                    <a href="{{ '/view-playlist/'.$playlist['0']->id }}" class="inline-btn">view playlist</a>
                </div>
                @endforeach
            @else
                <p class="empty">nothing bookmarked yet!</p>    
            @endif
        </div>

    </section>
@endsection
