<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\Playlist;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class ContentController extends Controller
{
    public function view_playlist($id)
    {
        $playlist = Playlist::where('id', $id)->orderBy('soft_delete')->get();
        $playlist_content = Content::where(['playlist_id' => $id, 'tutor_id' => Auth::user()->id])->get();
        return view('admin.playlist.content.view-content', compact('playlist', 'playlist_content'));
    }

    public function add_content($id = null)
    {
        if (Playlist::where('tutor_id', Auth::user()->id)->count() > 0) {
            $playlist = Playlist::where('tutor_id', Auth::user()->id)->get();
            return view('admin.playlist.content.add-content', compact('id', 'playlist'));
        } else {
            return back()->with('error', 'No playlist found...Please First Create Playlist..!!!');
        }
    }

    public function store_content(Request $request, $id = null)
    {
        $request->validate([
            // 'tutor_id' => ['required'],
            // 'playlist_id' => ['required'],
            'title' => ['string', 'max:255'],
            'description' => ['string'],
            'thumb' => ['mimes:jpeg,jpg,png', 'max:10000'],
            'video' => ['mimes:mp4,mov,ogg,m3u8,wmv', 'max:200000']
        ]);

        if (request()->hasfile('thumb')) {
            $thumbnail = time() . '.' . request()->thumb->getClientOriginalExtension();
            request()->thumb->move(public_path('Thumbnails/playlist/thumb-content'), $thumbnail);
        }

        if (request()->hasfile('video')) {
            $video = time() . '.' . request()->video->getClientOriginalExtension();
            request()->video->move(public_path('Thumbnails/playlist/video-content/'), $video);
        }

        $content = new Content();
        $content->tutor_id = Auth::user()->id;
        $content->playlist_id = $request['playlist'];
        $content->title = strip_tags($request['title']);
        $content->slug = Str::slug(Str::lower(strip_tags($request['title'])));
        $content->description = strip_tags($request['description']);
        $content->thumb = $thumbnail;
        $content->video = $video;
        $content->status = strip_tags($request['status']);
        // $content->save();
        if ($content->save()) {
            // return response()->json(['success'=>'You have successfully upload file.']);
            if ($id > 0) {
                return redirect('/admin/view-playlist/' . $id)->with('message', 'New Content Uploaded...');
            }
            return redirect('/admin/dashboard')->with('message', 'New Content Uploaded...');
        } else {
            return response()->with('error', 'Something Wrong!!!');
        }
    }


    public function update_content($id)
    {
        $old_content = Content::where(['id' => $id])->get();
        $playlist = Playlist::all();
        return view('admin.playlist.content.update-content', compact('old_content', 'playlist'));
    }


    public function store_update_content(Request $request, $id)
    {
        $request->validate([
            // 'tutor_id' => ['required'],
            // 'playlist_id' => ['required'],
            'title' => ['string', 'max:255'],
            'description' => ['string'],
            'thumb' => ['mimes:jpeg,jpg,png', 'max:10000'],
            'video' => ['mimes:mp4,mov,ogg,m3u8,wmv', 'max:200000']
        ]);

        $update_content = Content::find($id);
        $update_content->tutor_id = Auth::user()->id;
        $update_content->playlist_id = $request['playlist'];
        $update_content->title = strip_tags($request['title']);
        $update_content->slug = Str::slug(Str::lower(strip_tags($request['title'])));
        $update_content->description = strip_tags($request['description']);
        $update_content->status = strip_tags($request['status']);

        if (request()->hasfile('thumb')) {
            $destination = 'Thumbnails/playlist/thumb-content/' . $update_content->thumb;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $thumbnail = time() . '.' . request()->thumb->getClientOriginalExtension();
            request()->thumb->move(public_path('Thumbnails/playlist/thumb-content'), $thumbnail);
            $update_content->thumb = $thumbnail;
        }

        if (request()->hasfile('video')) {
            $destination = 'Thumbnails/playlist/video-content/' . $update_content->thumb;

            if (File::exists($destination)) {
                File::delete($destination);
            }

            $video = time() . '.' . request()->video->getClientOriginalExtension();
            request()->video->move(public_path('Thumbnails/playlist/video-content/'), $video);
            $update_content->video = $video;
        }

        if ($update_content->update()) {
            return redirect('/admin/view-playlist/' . $id)->with('message', 'Content Updated...');
        } else {
            return back()->with('error', 'Something Wrong!!!');
        }
    }


    public function delete_content($id)
    {
        $soft_delete = Content::find($id);
        $soft_delete->soft_delete = !$soft_delete->soft_delete;
        if ($soft_delete->update()) {
            return back()->with('message', 'Changes Updated...');
        } else {
            return back()->with('error', 'Something Want Wrong!!!');
        }
    }

    public function view_video_content($playlist, $video)
    {
        $video_info = Content::where('slug', $video)->get();
        // $comments = Comment::where('content_id',$video_info['0']->id)->orderBy('created_at','desc')->paginate(5);
        return view('admin.playlist.content.play-content', compact('video', 'playlist', 'video_info'));
    }

    public function content()
    {
        $contents = Content::where('tutor_id', Auth::user()->id)->where('soft_delete', '0')->where('status', '1')->get();
        return view('admin.playlist.content.view-all', compact('contents'));
    }
}
