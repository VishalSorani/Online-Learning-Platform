<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function index()
    {
        $tutors = User::where('user_type', '1')->get();
        return view('user.tutors', compact('tutors'));
    }

    public function view_profile($slug)
    {
        $tutor = User::where('slug', $slug)->get();
        return view('user.tutor-profile', compact('tutor'));
    }

    public function search_tutor(Request $request)
    {
        if ($request['search_tutor'] != '') {
            $tutor_info = User::where('name', 'like', '%' . $request['search_tutor'] . '%')->get();
        } else {
            $tutor_info = User::where('user_type', '1')->get();
        }
        return view('user.search-tutor', compact('tutor_info'));
    }

    public function tutor_request()
    {
        return view('user.request-form');
    }

    public function tutor_request_validate(Request $request)
    {
        $request->validate([
            'description' => ['required', 'string'],
            'experience' => ['required', 'string']
        ]);

        $teacher = new Teacher();
        $teacher->user_id = Auth::user()->id;
        $teacher->description = strip_tags($request['description']);
        $teacher->experience = strip_tags($request['experience']);
        if ($teacher->save()) {
            return redirect('tutors')->with('message', 'Your request has been saved. It\' take 2-3 working days to review. After you will get access of Tutor Role...Thank You For Your Time 🙏');
        } else {
            return redirect()->back()->with('error', 'OPPss Something want wrong...');
        }
    }
}
