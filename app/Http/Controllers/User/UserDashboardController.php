<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Enroll;
use App\Models\Like;
use App\Models\Playlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

use function PHPSTORM_META\map;

class UserDashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    public function comment()
    {
        $comments = Comment::where('user_id', Auth::user()->id)->paginate(10);
        return view('user.playlist.view-comments', compact('comments'));
    }

    public function view_courses()
    {
        $courses = Playlist::where(['status' => '1', 'soft_delete' => '0'])->inRandomOrder()->paginate(15);
        return view('user.courses', compact('courses'));
    }

    public function view_profile($id)
    {
        $users = User::where('id', $id)->get();
        return view('user.view-profile', compact('users'));
    }

    public function update_profile($id)
    {
        $current_profile = User::where('id', $id)->get();
        return view('user.update-profile', compact('current_profile'));
    }



    public function store_updated_profile(Request $request, $id)
    {
        $request->validate([
            // 'name' => ['unique:users'],
            // 'email' => ['unique:users']
        ]);

        $user = User::find($id);
        $user->name = strip_tags($request['name']);
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
            return redirect('/view-profile/' . $user->id)->with('message', 'Profile Updated...');
        } else {
            return back()->with('message', 'Something Want Wrong!!!');
        }
    }


    public function courses()
    {
        $courses = Enroll::where('user_id', Auth::user()->id)->get();
        return view('user.playlist.bookmark', compact('courses'));
    }

    public function likes()
    {
        $likes = Like::where('user_id', Auth::user()->id)->get();
        return view('user.playlist.like', compact('likes'));
    }

    public function unlikes(Request $request)
    {
        $likes = Like::where('user_id', Auth::user()->id)->get();
        if (Like::find($request['like_id'])->delete()) {
            return redirect('/likes')->with('likes');
        } else {
            return back()->with('likes');
        }
    }


    public function about()
    {
        return view('user.about');
    }

    public function contact()
    {
        return view('user.contact');
    }

    public function store_query(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:100', 'string'],
            'email' => ['required', 'max:100', 'email'],
            'number' => ['required', 'regex:/[0-9]{11}/'],
            'msg' => ['required', 'max:1000', 'string']
        ]);

        $contact = new Contact();
        $contact->name = strip_tags($request['name']);
        $contact->email = strip_tags($request['email']);
        $contact->number = strip_tags($request['number']);
        $contact->message = strip_tags($request['msg']);
        if ($contact->save()) {
            return redirect()->back()->with('message', 'Your Response Has Been Reached To Us. Thank You...');
        } else {
            return redirect()->back()->with('error', 'Oppps!!!');
        }
    }


    public function search_course_category($cat)
    {
        $find_courses = Playlist::where('category', $cat)->where('status', '1')->where('soft_delete', '0')->orderBy('created_at', 'DESC')->get();
        return view('user.search-course', compact('find_courses'));
    }

    public function search_course_name(Request $request, $name = '')
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
        return view('user.search-course', compact('find_courses'));
    }
}
