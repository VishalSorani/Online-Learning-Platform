@extends('user.layouts.header-nav')
@section('title', 'Home')
@section('main')
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
    <section class="quick-select">
        <h1 class="heading">quick options</h1>

        <div class="box-container">
            @if (Auth::check())
                <div class="box">
                    @php
                        $likes = DB::table('likes')->where('user_id',Auth::user()->id)->count();
                        $comments = DB::table('comments')->where('user_id',Auth::user()->id)->count();
                        $bookmark = DB::table('enrolls')->where('user_id',Auth::user()->id)->count();
                    @endphp
                    <h3 class="title">likes and comments</h3>
                    <p>total likes : <span>{{ $likes }}</span></p>
                    <a href="{{ route('likes') }}" class="inline-btn">view likes</a>
                    <p>total comments : <span>{{ $comments }}</span></p>
                    <a href="{{ '/comments' }}" class="inline-btn">view comments</a>
                    <p>saved playlist : <span>{{ $bookmark }}</span></p>
                    <a href="{{ route('bookmark') }}" class="inline-btn">view bookmark</a>
                </div>
            @else
                <div class="box" style="text-align: center;">
                    <h3 class="title">please login or register</h3>
                    <div class="flex-btn" style="padding-top: .5rem;">
                        <a href="{{ route('login') }}" class="option-btn">login</a>
                        <a href="{{ route('register') }}" class="option-btn">register</a>
                    </div>
                </div>
            @endif

            <div class="box">
                <h3 class="title">top categories</h3>
                <div class="flex">
                    <a href="{{ '/course/search/'.'development' }}"><i class="fas fa-code"></i><span>development</span></a>
                    <a href="{{'/course/search/'.'business' }}"><i class="fas fa-chart-simple"></i><span>business</span></a>
                    <a href="{{ '/course/search/'.'design' }}"><i class="fas fa-pen"></i><span>design</span></a>
                    <a href="{{ '/course/search/'.'marketing' }}"><i class="fas fa-chart-line"></i><span>marketing</span></a>
                    <a href="{{ '/course/search/'.'music' }}"><i class="fas fa-music"></i><span>music</span></a>
                    <a href="{{ '/course/search/'.'photography' }}"><i class="fas fa-camera"></i><span>photography</span></a>
                    <a href="{{ '/course/search/'.'software' }}"><i class="fas fa-cog"></i><span>software</span></a>
                    <a href="{{ '/course/search/'.'medical' }}"><i class="fas fa-vial"></i><span>medical</span></a>
                </div>
            </div>

            {{-- <div class="box">
                <h3 class="title">popular topics</h3>
                <div class="flex">
                    <form action="" method="post">
                        <a href="{{ '/course/search/'.'HTML' }}"><i class="fab fa-html5"></i><span>HTML</span></a>
                    </form>
                    <form action="" method="post">
                    <a href="#"><i class="fab fa-css3"></i><span>CSS</span></a>
                </form>

                    <form action="" method="post">
                    <a href="#"><i class="fab fa-js"></i><span>javascript</span></a>
                </form>

                    <form action="" method="post">
                    <a href="#"><i class="fab fa-react"></i><span>react</span></a>


                    <form action="" method="post">
                    <a href="#"><i class="fab fa-php"></i><span>PHP</span></a>


                    <form action="" method="post">
                    <a href="#"><i class="fab fa-bootstrap"></i><span>bootstrap</span></a>
                </div>
            </div> --}}

            <div class="box tutor">
                <h3 class="title">become a tutor</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, laudantium.</p>
                <a href="{{'/tutors'}}" class="inline-btn">get started</a>
            </div>

        </div>

    </section>


    @php
        // $current_date =  date('Y-m-d');
        $latest_course = DB::table('playlists')->where('status',1)->where('soft_delete',0)->whereDate('created_at', '>=', now()->subDays(30))->limit(6)->get();
    @endphp

    <section class="courses">
        <h1 class="heading">latest courses</h1>
        <div class="box-container">
            @if (count($latest_course) > 0)
                @foreach ($latest_course as $item)
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
                <p class="empty">no courses added yet!</p> 
            @endif
           
            
      

        </div>

        <div class="more-btn">
            <a href="#" class="inline-option-btn">view more</a>
        </div>

    </section>

@endsection
