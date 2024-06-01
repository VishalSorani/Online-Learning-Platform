@extends('admin.layouts.header-nav')
@section('title', $video)
@section('content')
    <section class="view-content">
        @foreach ($video_info as $info)
            <div class="container">
                <video id="protected-video" src="{{ asset('Thumbnails/playlist/video-content/' . $info->video) }}" autoplay
                    controls controlsList="nodownload" poster="{{ asset('Thumbnails/playlist/thumb-content/' . $info->thumb) }}"
                    class="video"></video>
                <div class="date"><i class="fas fa-calendar"></i><span>{{ $info->created_at->toDateString() }}</span></div>
                <h3 class="title">{{ $info->title }}</h3>

                @php
                    $likes = DB::table('likes')
                        ->where('content_id', $info->id)
                        ->count();
                    $comments = DB::table('comments')
                        ->where('content_id', $info->id)
                        ->count();
                @endphp
                <div class="flex">
                    <div><i class="fas fa-heart"></i><span>{{ $likes }}</span></div>
                    <div><i class="fas fa-comment"></i><span>{{ $comments }}</span></div>
                </div>
                <div class="description">{{ $info->description }}</div>
                {{-- <form action="" method="post">
                <div class="flex-btn">
                    <input type="hidden" name="video_id" value="">
                    <a href="" class="option-btn" di>update</a>
                    <input type="submit" disabled value="delete" class="delete-btn" onclick="return confirm('delete this video?');"
                        name="delete_video">
                </div>
            </form> --}}
            </div>
        @endforeach
    </section>

    <section class="comments">

        <h1 class="heading">user comments</h1>

        <div class="show-comments">
            @php
                $comments = DB::table('comments')
                    ->where('content_id', $info->id)
                    ->orderBy('created_at', 'desc')
                    ->cursorPaginate(15);
            @endphp
            @if (count($comments) > 0)
                @foreach ($comments as $comment)
                    <div class="box">
                        @php
                            $user = DB::table('users')
                                ->where('id', $comment->user_id)
                                ->get();
                        @endphp
                        <div class="user">
                            <img src="{{ asset('Profile/' . $user['0']->profile) }}" alt="">
                            <div>
                                <h3>{{ $user['0']->name }}</h3>
                                <span>{{ $user['0']->profession }}</span>
                            </div>
                        </div>
                        <p class="text">{{ $comment->comment }}</p>
                        @if ($comment->user_id == Auth::user()->id)
                            <form action="{{ '/delete-comment/' . $playlist . '/' . $info->slug }}" method="post"
                                class="flex-btn">
                                @csrf
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                {{-- <button type="submit" name="edit_comment" class="inline-option-btn">edit comment</button> --}}
                                <button type="submit" name="delete_comment" class="inline-delete-btn"
                                    onclick="return confirm('delete this comment?');">delete comment</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            @else
                <p class="empty">no comments added yet!</p>
            @endif

        </div>
        <div class="pagination">
            {!! $comments->links('pagination::bootstrap-4') !!}
        </div>
    </section>
    <script>
        // Disable right-click context menu on the video element
        const protectedVideo = document.getElementById('protected-video');
        protectedVideo.addEventListener('contextmenu', (e) => {
            e.preventDefault();
            alert('Right-click menu is disabled. Downloading is not allowed.');
        });
    </script>
@endsection
