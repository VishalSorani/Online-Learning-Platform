<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Playlist;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function about()
    {
        return view('admin.about-us');
    }

    public function view_profile($id)
    {
        return view('admin.view-profile', compact('id'));
    }

    public function update_profile($id)
    {
        $current_profile = User::where('id', $id)->get();
        return view('admin.update-profile', compact('current_profile'));
    }

    public function store_updated_profile(Request $request, $id)
    {
        $request->validate([
            // 'name' => ['unique:users', 'max:50'],
            // 'email' => ['unique:users', 'max:50']
        ]);

        $user = User::find($id);
        $user->name = strip_tags($request['name']);
        $user->profession = $request['profession'];
        $user->email = strip_tags($request['email']);

        if ($request['password'] == $request['password_confirmation'] && $request['password'] != null) {
            $user->password = Hash::make(strip_tags($request['password']));
        }

        if (request()->hasfile('image')) {
            $destination = '/Profile/' . $user->profile;

            if (File::exists($destination)) {
                File::delete($destination);
            }

            $profile = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('/Profile/'), $profile);
            $user->profile = $profile;
        }

        if ($user->update()) {
            return redirect('/admin/view-profile/' . $user->id)->with('message', 'Profile Updated...');
        } else {
            return back()->with('message', 'Something Want Wrong!!!');
        }
    }



    public function comment()
    {
        $comments = Comment::where('tutor_id', Auth::user()->id)->paginate(10);
        return view('admin.playlist.content.view-comments', compact('comments'));
    }


    public function likes()
    {
        $likes = Like::where('tutor_id', Auth::user()->id)->get();
        return view('admin.playlist.content.like', compact('likes'));
    }


    public function search(Request $request, $name = '')
    {
        if ($name != null) {
            $find_courses = Playlist::where('title', 'like', '%' . $name . '%')->where('status', '1')->where('soft_delete', '0')->orderBy('created_at', 'DESC')->get();;
        } else {
            if ($request['search'] != '') {
                $find_courses = Playlist::where('title', 'like', '%' . $request['search'] . '%')->where('status', '1')->where('soft_delete', '0')->orderBy('created_at', 'DESC')->get();;
            } else {
                $find_courses = Playlist::where('status', '1')->where('soft_delete', '0')->orderBy('created_at', 'DESC')->get();;
            }
        }
        return view('admin.search-course', compact('find_courses'));
    }


    public function tutor_request(){
        $tutors = Teacher::where('status','0')->orderBy('created_at','DESC')->paginate(5);
        return view('admin.request', compact('tutors'));
    }

    public function tutor_request_update($id){
        $update = Teacher::where('user_id',$id)->update(['status'=>'1']);
        $access = User::where('id',$id)->update(['user_type'=>'1']);

        return back()->with('message','Request is Approved');
    }

    public function tutor_request_reject($id){
        $update = Teacher::where('user_id',$id)->delete();
    
        return back()->with('message','Request is Rejected');
    }
}
