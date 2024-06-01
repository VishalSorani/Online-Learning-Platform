@extends('user.layouts.header-nav')
@section('title', 'Search Tutors')
@section('main')
<section class="teachers">
    <h1 class="heading">expert tutors</h1>

    <form action="{{ '/tutors/search' }}" method="post" class="search-tutor">
        @csrf
        <input type="text" name="search_tutor" maxlength="100" placeholder="search tutor..." required>
        <button type="submit" name="search_tutor_btn" class="fas fa-search"></button>
    </form>

    <div class="box-container">
        @if (!empty($tutor_info))
            @foreach ($tutor_info as $tutor)
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
                    <form action="{{ route('tutors-profile',$tutor->slug) }}" method="post">
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