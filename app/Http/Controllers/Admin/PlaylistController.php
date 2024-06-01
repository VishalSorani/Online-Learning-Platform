<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;



class PlaylistController extends Controller
{
    public function view_playlist()
    {
        $playlist = Playlist::where(['tutor_id' => Auth::user()->id, 'soft_delete' => false])->get();
        return view('admin.playlist.view-playlist', compact('playlist'));
    }

    public function add_playlist()
    {
        $categories = Category::all();
        return view('admin.playlist.add-playlist', compact('categories'));
    }

    public function store_playlist(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'thumb' => ['mimes:jpeg,jpg,png', 'required', 'max:10000'],
            'status' => ['required'],
        ]);

        if (request()->hasfile('thumb')) {
            $thumbnail = time() . '.' . request()->thumb->getClientOriginalExtension();
            request()->thumb->move(public_path('Thumbnails/playlist/'), $thumbnail);
        }

        $playlist = new Playlist();
        $playlist->tutor_id = Auth::user()->id;
        $playlist->title = $request['title'];
        $playlist->category = $request['category'];
        $playlist->slug = Str::slug(Str::lower($request['title']));
        $playlist->description = $request['description'];
        $playlist->thumb = $thumbnail;
        $playlist->status = $request['status'];
        if ($playlist->save()) {
            return redirect('admin/playlist')->with('message', 'New Playlist Created...');
        } else {
            return back()->with('message', 'Something Wrong!!!');
        }
    }


    public function update_playlist($id)
    {
        $old_playlist_info = Playlist::where('id', $id)->get();
        $categories = Category::all();
        return view('admin.playlist.update-playlist', compact('old_playlist_info', 'categories'));
    }

    public function store_update_playlist($id, Request $request)
    {
        $request->validate([
            'title' => ['string', 'max:255'],
            'description' => ['string'],
            'thumb' => ['mimes:jpeg,jpg,png', 'max:10000'],
            'status' => [''],
        ]);

        $update_playlist = Playlist::find($id);
        $update_playlist->tutor_id = Auth::user()->id;
        $update_playlist->title = $request['title'];
        $update_playlist->slug = Str::slug(Str::lower($request['title']));
        $update_playlist->description = $request['description'];
        $update_playlist->status = $request['status'];

        if (request()->hasfile('updated_thumb')) {
            $destination = 'Thumbnails/playlist/' . $update_playlist->thumb;

            if (File::exists($destination)) {
                File::delete($destination);
            }

            $thumbnail = time() . '.' . request()->updated_thumb->getClientOriginalExtension();
            request()->updated_thumb->move(public_path('Thumbnails/playlist/'), $thumbnail);
            $update_playlist->thumb = $thumbnail;
        }

        if ($update_playlist->update()) {
            return redirect('/admin/playlist')->with('message', 'Playlist Updated...');
        } else {
            return back()->with('message', 'Something Want Wrong!!!');
        }
    }

    public function delete_playlist($id)
    {
        $soft_delete = Playlist::find($id);
        $soft_delete->soft_delete = !$soft_delete->soft_delete;
        if ($soft_delete->update()) {
            return back()->with('message', 'Changes Updated...');
        } else {
            return back()->with('error', 'Something Want Wrong!!!');
        }
    }
}
