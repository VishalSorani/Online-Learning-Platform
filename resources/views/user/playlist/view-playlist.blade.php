@extends('user.layouts.header-nav')
@section('title', 'View Playlist')
@section('main')
    <section class="playlist">
        @if (session('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
            <button type="button" class="closebtn" data-bs-dismiss="alert"
                onclick="this.parentElement.style.display='none';" aria-label="Close">X</button>
        </div>
     @endif
     
     @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
            <button type="button" class="closebtn" data-bs-dismiss="alert"
                onclick="this.parentElement.style.display='none';" aria-label="Close">X</button>
        </div>
     @endif
     
        <h1 class="heading">playlist details</h1>
        @if (count($playlist_info) > 0)
            <div class="row">
                <div class="col">
                    <form action="#"  class="save-list">
                        <input type="hidden" name="list_id" value="">
                        @php
                            if(Auth::check()){
                                $enroll = DB::table('enrolls')
                                    ->where('playlist_id', $playlist_info['0']->id)
                                    ->where('user_id', Auth::user()->id)
                                    ->get();
                            }
                              
                        @endphp
                        @if (Auth::check() && count($enroll) == 1)
                            <button type="submit" name="save_list" disabled><i
                                    class="fas fa-bookmark"></i><span>Enrolled 😊</span></button>
                        @else
                            <button type="submit" name="save_list" disabled><i class="far fa-bookmark"></i><span>save
                                    playlist</span></button>
                        @endif
                    </form>
                    @php
                        $count_video = DB::table('contents')
                            ->where('playlist_id', $playlist_info['0']->id)
                            ->count();
                    @endphp

                    <div class="thumb">
                        <span>{{ $count_video }} videos</span>
                        <img src="{{ asset('Thumbnails/playlist/' . $playlist_info['0']->thumb) }}" alt="">
                    </div>
                </div>
                @php
                    $user = DB::table('users')
                        ->where('id', $playlist_info['0']->tutor_id)
                        ->get();
                @endphp
                <div class="col">
                    <div class="tutor">
                        <img src="{{ '/Profile/' . $user['0']->profile }}" alt="">
                        <div>
                            <h3>{{ $user['0']->name }}</h3>
                            <span>{{ $user['0']->profession }}</span>
                        </div>
                    </div>
                    <div class="details">
                        <h3>{{ $playlist_info['0']->title }} </h3>
                        <p>{{ substr($playlist_info['0']->description, 0, 190) }}...</p>
                        <div class="date"><i
                                class="fas fa-calendar"></i><span>{{ date('Y-m-d', strtotime($playlist_info['0']->created_at)) }}</span>
                        </div>
                        @php
                        if (Auth::check()) {
                            $enroll = DB::table('enrolls')
                                    ->where('playlist_id', $playlist_info['0']->id)
                                    ->where('user_id', Auth::user()->id)
                                    ->get();
                        }
                              
                        @endphp
                        @if (Auth::check())
                            @if(count($enroll) == 1)
                                <a href="" class="inline-btn" style="visibility: hidden">Already Enroll</a>
                            @else
                                <a href="{{ route('enroll',$playlist_info['0']->id) }}" class="inline-btn">Enroll</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="inline-btn">Login To Enroll</a>
                        @endif
                    </div>
                </div>

            </div>
    </section>

    <section class="videos-container">

        <h1 class="heading">playlist videos</h1>
        @php
            $item = DB::table('contents')
                ->where('playlist_id', $playlist_info['0']->id)->where('status','1')->where('soft_delete','0')
                ->get();
            if (Auth::check()) {
                $enroll = DB::table('enrolls')
                ->where('playlist_id', $playlist_info['0']->id)
                ->where('user_id', Auth::user()->id)
                ->get();
            }
            
        @endphp

        <div class="box-container">
            @foreach ($item as $content)
                @if (count($item) > 0 && Auth::check() && count($enroll) == 1)
                    <a href="{{ route('view-video', [$playlist_info['0']->slug, $content->slug]) }}" class="box">
                        <i class="fas fa-play"></i>
                        <img src="{{ asset('/Thumbnails/playlist/thumb-content/' . $content->thumb) }}" alt="">
                        <h3>{{ $content->title }}</h3>
                    </a>
                @else
                    {{-- @if ($content['0']->id == 1) --}}
                    <a href="" onclick="return alert('Either Login or Enroll into Course');" class="box">
                        <i class="fas fa-play"></i>
                        <img src="{{ asset('/Thumbnails/playlist/thumb-content/' . $content->thumb) }}" alt="">
                        <h3>{{ $content->title }}</h3>
                    </a>
                @endif
            @endforeach

            @if (count($item) == 0)
                <p class="empty">no videos added yet!</p>
            @endif
        @else
            <p class="empty">this playlist was not found!</p>
            @endif


        @endsection
