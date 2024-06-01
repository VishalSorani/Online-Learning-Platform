@extends('user.layouts.header-nav')
@section('title', 'Tutor Profile')
@section('main')
    @if (!empty($tutor))
        @foreach ($tutor as $info)
            <section class="tutor-profile">

                <h1 class="heading">profile details</h1>

                <div class="details">
                    <div class="tutor">
                        <img src="{{ asset('/Profile/' . $info->profile) }}" alt="">
                        <h3>{{ $info->name }}</h3>
                        <span>{{ $info->profession }}</span>
                    </div>
                    @php
                        $likes = DB::table('likes')
                            ->where('tutor_id', $info->id)
                            ->count();
                        $comments = DB::table('comments')
                            ->where('tutor_id', $info->id)
                            ->count();
                        $playlist = DB::table('playlists')
                            ->where('tutor_id', $info->id)
                            ->count();
                        $videos = DB::table('contents')
                            ->where('tutor_id', $info->id)
                            ->count();
                    @endphp
                    <div class="flex">
                        <p>total playlists : <span>{{ $playlist }}</span></p>
                        <p>total videos : <span>{{ $videos }}</span></p>
                        <p>total likes : <span>{{ $likes }}</span></p>
                        <p>total comments : <span>{{ $comments }}</span></p>
                    </div>
                </div>

            </section>
        @endforeach

        <section class="courses">

            <h1 class="heading">latest courese</h1>
            <div class="box-container">
                @php
                    $latest_course = DB::table('playlists')
                        ->where('tutor_id', $tutor['0']->id)
                        ->orderBy('created_at')
                        ->get();
                @endphp
            
                @if (count($latest_course) > 0)
                    @foreach ($latest_course as $course)
                        <div class="box">
                            <div class="tutor">
                                <img src="{{ asset('/Profile/' . $info->profile) }}" alt="">
                                <div>
                                    <h3>{{ $info->name }}</h3>
                                    <span>{{ date('Y-m-d', strtotime($course->created_at)) }}</span>
                                </div>
                            </div>
                            <img src="{{ asset('/Thumbnails/playlist/' . $course->thumb) }}" class="thumb" alt="">
                            <h3 class="title">{{ $course->title }}</h3>
                            <a href="{{ '/view-playlist/' . $course->id }}" class="inline-btn">view playlist</a>
                        </div>
                    @endforeach
                @else
                    <p class="empty">no courses added yet!</p>
                @endif

            </div>

        </section>
    @else
        <p class="empty">Tutor not Found!</p>
    @endif


@endsection
