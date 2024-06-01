@extends('user.layouts.header-nav')
@section('title', 'Likes')
@section('main')
    <section class="liked-videos">

        <h1 class="heading">liked videos</h1>

        <div class="box-container">
            @if (!empty($likes))
                @foreach ($likes as $like)
                    @php
                        $content = DB::table('contents')
                            ->where('id', $like->content_id)
                            ->get();
                        $user = DB::table('users')
                            ->where('id', $content['0']->tutor_id)
                            ->get();
                        $playlist = DB::table('playlists')
                            ->where('id', $content['0']->playlist_id)
                            ->get();
                    @endphp
                    <div class="box">
                        <div class="tutor">
                            <img src="{{ asset('/Profile/' . $user['0']->profile) }}" alt="">
                            <div>
                                <h3>{{ $user['0']->name }}</h3>
                                <span>{{ date('Y-m-d', strtotime($content['0']->created_at)) }}</span>
                            </div>
                        </div>
                        <img src="{{ asset('/Thumbnails/playlist/thumb-content/' . $content['0']->thumb) }}" alt=""
                            class="thumb">
                        <h3 class="title">{{ $content['0']->title }}</h3>
                        <form action="" method="post" class="flex-btn">
                            @csrf
                            <input type="hidden" name="like_id" value="{{ $like->id }}">
                            <a href="{{ route('view-video', [$playlist['0']->slug, $content['0']->slug]) }}"
                                class="inline-btn">watch video</a>
                            <input type="submit" value="remove" class="inline-delete-btn" name="remove">
                        </form>
                    </div>
                @endforeach
            @else
                <p class="empty">nothing added to likes yet!</p>
            @endif
        </div>

    </section>
@endsection
