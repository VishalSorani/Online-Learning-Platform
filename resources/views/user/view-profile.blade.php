@extends('user.layouts.header-nav')
@section('title','Profile')
@section('main')
<section class="profile">
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

    <h1 class="heading">profile details</h1>
    @foreach ($users as $user)
    <div class="details">
       <div class="user">
          <img src="{{asset('Profile/'.$user->profile)}}" alt="">
          <h3>{{$user->name}}</h3>
          <p>{{$user->profession}}</p>
          <a href="{{ route('update-user-profile',$user->id) }}" class="inline-btn">update profile</a>
       </div>
 
       <div class="box-container">
            @php
                  $likes = DB::table('likes')->where('user_id',Auth::user()->id)->count();
                  $comments = DB::table('comments')->where('user_id',Auth::user()->id)->count();
                  $bookmark = DB::table('enrolls')->where('user_id',Auth::user()->id)->count();
            @endphp
          <div class="box">
             <div class="flex">
                <i class="fas fa-bookmark"></i>
                <div>
                   <h3>{{ $bookmark }}</h3>
                   <span>saved playlists</span>
                </div>
             </div>
             <a href="{{ route('bookmark') }}" class="inline-btn">view playlists</a>
          </div>
 
          <div class="box">
             <div class="flex">
                <i class="fas fa-heart"></i>
                <div>
                   <h3>{{ $likes }}</h3>
                   <span>liked tutorials</span>
                </div>
             </div>
             <a href="{{ route('likes') }}" class="inline-btn">view liked</a>
          </div>
 
          <div class="box">
             <div class="flex">
                <i class="fas fa-comment"></i>
                <div>
                   <h3>{{ $comments }}</h3>
                   <span>video comments</span>
                </div>
             </div>
             <a href="/comments" class="inline-btn">view comments</a>
          </div>
 
       </div>
 
    </div>
    @endforeach
 </section>
 
@endsection