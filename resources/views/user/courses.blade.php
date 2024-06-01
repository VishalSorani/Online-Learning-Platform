@extends('user.layouts.header-nav')
@section('title','All Courses')
@section('main')
<section class="courses">
    <h1 class="heading">all courses</h1>
    <div class="box-container">
        @if (!empty($courses))
            @foreach ($courses as $course)
                @php
                    $user = DB::table('users')->where('id',$course->tutor_id)->get();
                @endphp
                <div class="box">
                    <div class="tutor">
                        <img src="{{ asset('/Profile/'.$user['0']->profile) }}" alt="not found">
                        <div>
                            <h3>{{ $user['0']->name }}</h3>
                            <span>{{ date('Y-m-d', strtotime($course->created_at)) }}</span>
                        </div>
                    </div>
                    <img src="{{ asset('/Thumbnails/playlist/' . $course->thumb) }}" class="thumb" alt="">
                    <h3 class="title">{{ $course->title }}</h3>
                    <a href="{{ '/view-playlist/'.$course->id }}" class="inline-btn">view playlist</a>
                </div>                      
            @endforeach
        @else
            <p class="empty">no courses added yet!</p>
        @endif
    </div>
    <div class="pagination">
        {!! $courses->links("pagination::bootstrap-4") !!}
    </div>
 </section>
 
@endsection