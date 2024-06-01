@extends('user.layouts.header-nav')
@section('title', $video)
@section('main')
    <section class="watch-video">
        @foreach ($video_info as $info)
        <div class="video-details">
            <video id="protected-video" src="{{ asset('Thumbnails/playlist/video-content/'.$info->video) }}" class="video"
                poster="{{ asset('Thumbnails/playlist/thumb-content/'.$info->thumb) }}" controls controlsList="nodownload"></video>
            <h3 class="title">{{ $info->title }}</h3>
            <div class="info">
                <p><i class="fas fa-calendar"></i><span>{{ $info->created_at->toDateString() }}</span></p>
                @php
                   $totalLike = DB::table('likes')->where('content_id',$info->id)->count();
               @endphp
                <p><i class="fas fa-heart"></i><span>{{ $totalLike }} likes</span></p>
            </div>

            @php
                $tutor = DB::table('users')->where('id',$info->tutor_id)->get();
            @endphp
            <div class="tutor heading">
                <img src="{{asset('Profile/'.$tutor['0']->profile)}}" alt="">
                <div>
                    <h3>{{$tutor['0']->name}}</h3>
                    <span>{{$tutor['0']->profession}}</span>
                </div>
            </div>
            <form action="{{ '/like-content/'.$playlist.'/'.$info->slug }}" method="post" class="flex">
                @csrf
                <input type="hidden" name="content_id" value="{{ $info->id }}">
                <a href="{{ '/view-playlist/'.$info->playlist_id }}" class="inline-btn">view playlist</a>
               @php
                   $checkLike = DB::table('likes')->where('content_id',$info->id)->where('user_id',Auth::user()->id)->count();
               @endphp
                @if ($checkLike == 1)
                    <button type="submit" name="like_content"><i class="fas fa-heart"></i><span>liked</span></button>
                @else
                    <button type="submit" name="like_content"><i class="far fa-heart"></i><span>like</span></button>
                @endif
            </form>
            <div class="description ">
                <p>{{ $info->description }}</p>
            </div>
        </div>
        @endforeach
    </section>

    <!-- watch video section ends -->

    <!-- comments section starts  -->

    <section class="comments">

        <h1 class="heading">add a comment</h1>

        <form action="{{ '/comment-content/'.$playlist.'/'.$info->slug }}" method="post" class="add-comment">
           @csrf
            <input type="hidden" name="content_id" value="{{ $info->id }}">
            <textarea name="comment_box" required placeholder="write your comment..." maxlength="1000" cols="30"
                rows="10"></textarea>
            <input type="submit" value="add comment" name="add_comment" class="inline-btn">
        </form>

        <h1 class="heading">user comments</h1>


        <div class="show-comments">
            @if (!empty($comments))
                @foreach ($comments as $comment)
                <div class="box" style="order:-1">
                    <div class="user">
                        @php
                            $user = DB::table('users')->where('id',$comment->user_id)->get();
                        @endphp
                        <img src="{{asset('Profile/'.$user['0']->profile)}}" alt="">
                        <div>
                            <h3>{{$user['0']->name}}</h3>
                            <span>{{$user['0']->profession}}</span>
                        </div>
                    </div>
                    <p class="text">{{ $comment->comment }}</p>
                    @if ($comment->user_id == Auth::user()->id)
                        <form action="{{ '/delete-comment/'.$playlist.'/'.$info->slug }}" method="post" class="flex-btn">
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
            {!! $comments->links("pagination::bootstrap-4") !!}
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
