@extends('user.layouts.header-nav')
@section('title', 'comments')
@section('main')
<section class="comments">
    <h1 class="heading">Your comments</h1>


    <div class="show-comments">
        @if (!empty($comments))
            @foreach ($comments as $comment)
                @php
                    $title = DB::table('contents')->where('id',$comment->content_id)->get();
                    $playlist = DB::table('playlists')->where('id',$title['0']->playlist_id)->get();
                @endphp
            <div class="box" style="order:-1">
                <div class="content"><span>{{ date('Y-m-d', strtotime($comment->created_at)) }}</span><p> - {{ $title['0']->title }} - </p><a href="{{ route('view-video',[$playlist['0']->slug,$title['0']->slug]) }}">view content</a></div>
                <p class="text">{{ $comment->comment }}</p>
                @if ($comment->user_id == Auth::user()->id)
                    <form action="{{ '/comment/' }}" method="post" class="flex-btn">
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
@endsection