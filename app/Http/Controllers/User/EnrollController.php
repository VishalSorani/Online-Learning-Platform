<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Enroll;
use App\Models\m;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollController extends Controller
{
   public function enroll($id)
   {
      $enroll = new Enroll();
      $enroll->playlist_id = $id;
      $enroll->user_id = Auth::user()->id;

      if ($enroll->save()) {
         return redirect('/view-playlist/' . $id)->with('message', 'You Enroll Into Course Successfully...');
      } else {
         return back()->with('message', 'Something Want Wrong!!!');
      }
   }
}
