@extends('user.layouts.header-nav')
@section('title', 'Search Course')
@section('main')
<section class="courses">
    <h1 class="heading">Search Results</h1>
    <div class="box-container">
        @if (count($find_courses) > 0)
            @foreach ($find_courses as $item)
                @php
                    $user = DB::table('users')->where('id',$item->tutor_id)->get();
                @endphp
                <div class="box">
                    <div class="tutor">
                        <img src="{{ asset('/Profile/'.$user['0']->profile) }}" alt="">
                        <div>
                            <h3>{{ $user['0']->name }}</h3>
                            <span>{{ date('Y-m-d', strtotime($item->created_at)) }}</span>
                        </div>
                    </div>
                    <img src="{{ asset('/Thumbnails/playlist/' . $item->thumb) }}" class="thumb" alt="">
                    <h3 class="title">{{ $item->title }}</h3>
                    <a href="{{ '/view-playlist/'.$item->id }}" class="inline-btn">view playlist</a>
                </div>
            @endforeach
        @else
            <p class="empty">no such courses fount</p> 
        @endif
  </div>
</section>
@endsection