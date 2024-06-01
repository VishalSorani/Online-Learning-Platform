<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Playlist;
use App\Models\Content;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function view_playlist($id)
    {
        $playlist_info = Playlist::where('id', $id)->get();
        return view('user.playlist.view-playlist', compact('playlist_info'));
    }

    public function view_video_content($playlist, $video)
    {
        $video_info = Content::where('slug', $video)->get();
        $comments = Comment::where('content_id', $video_info['0']->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('user.playlist.view-content ', compact('video_info', 'video', 'playlist', 'comments'));
    }

    public function like(Request $request, $playlist, $video)
    {
        $tutor_id = Content::where('slug', $video)->get('tutor_id');
        $video_info = Content::where('slug', $video)->get();
        $comments = Comment::orderBy('created_at', 'desc')->paginate(5);

        $checkLike = Like::where('content_id', $request['content_id'])->where('user_id', Auth::user()->id)->get();
        if (count($checkLike) == 1) {
            if (Like::where('content_id', $request['content_id'])->where('user_id', Auth::user()->id)->delete()) {
                return redirect('/view-playlist/' . $playlist . '/' . $video)->with('video_info', 'video', 'playlist', 'comments');
            }
        } else {
            $like = new Like();
            $like->user_id = Auth::user()->id;
            $like->content_id = $request['content_id'];
            $like->tutor_id = $tutor_id['0']->tutor_id;
            if ($like->save()) {
                return redirect('/view-playlist/' . $playlist . '/' . $video)->with('video_info', 'video', 'playlist', 'comments');
            }
        }
    }

    public function comment(Request $request, $playlist, $video)
    {
        $tutor_id = Content::where('slug', $video)->get('tutor_id');
        $video_info = Content::where('slug', $video)->get();
        $comments = Comment::orderBy('created_at', 'desc')->paginate(5);
        
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->content_id = $request['content_id'];
        $comment->tutor_id = $tutor_id['0']->tutor_id;
        $comment->comment = strip_tags($request['comment_box']);
        if ($comment->save()) {
            return redirect('/view-playlist/' . $playlist . '/' . $video)->with('video_info', 'video', 'playlist', 'comments');
        }
        // }
    }

    public function delete_comment(Request $request, $playlist, $video)
    {
        $video_info = Content::where('slug', $video)->get();
        $comments = Comment::orderBy('created_at', 'desc')->paginate(5);
        if (Comment::find($request['comment_id'])->delete()) {
            return redirect('/view-playlist/' . $playlist . '/' . $video)->with('video_info', 'video', 'playlist', 'comments');
        }
    }
}
