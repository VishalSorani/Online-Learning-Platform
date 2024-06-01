@extends('user.layouts.header-nav')
@section('title','About Us')
@section('main')
<section class="about">

    <div class="row">
 
       <div class="image">
          <img src="{{('assets/images/about-img.svg')}}" alt="">
       </div>
 
       <div class="content">
          <h3>why choose us?</h3>
          <p>We are committed to making a positive impact on the lives of individuals worldwide through education. Our team works tirelessly to ensure that our courses are up-to-date, engaging, and relevant to the challenges of today's world. We are always open to feedback and suggestions from our students to continuously improve our offerings.</p>
          <p>Join us on this incredible journey of learning, growth, and self-discovery. Together, we can bridge the gap between education and opportunity, breaking down barriers one course at a time. Welcome to where knowledge is free, and the possibilities are endless.</p>
          <a href="/courses" class="inline-btn">our courses</a>
       </div>
 
    </div>
 
    <div class="box-container">
 
       <div class="box">
          <i class="fas fa-graduation-cap"></i>
          @php
              $course = DB::table('playlists')->count();
          @endphp
          <div>
             <h3>{{ $course }}</h3>
             <span>online courses</span>
          </div>
       </div>
 
       <div class="box">
          <i class="fas fa-user-graduate"></i>
          @php
              $student = DB::table('users')->where('user_type','!=','2')->count();
          @endphp
          <div>
             <h3>+{{$student}}</h3>
             <span>brilliants students</span>
          </div>
       </div>
 
       <div class="box">
          <i class="fas fa-chalkboard-user"></i>
            @php
                $teacher = DB::table('users')->where('user_type', '1')->count();
            @endphp
          <div>
             <h3>+{{ $teacher }}</h3>
             <span>expert teachers</span>
          </div>
       </div>
    </div>
 
 </section>


 <section class="reviews">

    <h1 class="heading">student's reviews</h1>
 
    <div class="box-container">
 
       <div class="box">
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo fugiat, quaerat voluptate odio consectetur assumenda fugit maxime unde at ex?</p>
          <div class="user">
             <img src="{{('assets/images/pic-2.jpg')}}" alt="">
             <div>
                <h3>Unknown</h3>
                <div class="stars">
                   <i class="fas fa-star"></i>
                   <i class="fas fa-star"></i>
                   <i class="fas fa-star"></i>
                   <i class="fas fa-star"></i>
                   <i class="fas fa-star-half-alt"></i>
                </div>
             </div>
          </div>
       </div>
 
       <div class="box">
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo fugiat, quaerat voluptate odio consectetur assumenda fugit maxime unde at ex?</p>
          <div class="user">
             <img src="{{('assets/images/pic-3.jpg')}}" alt="">
             <div>
                <h3>Unknown</h3>
                <div class="stars">
                   <i class="fas fa-star"></i>
                   <i class="fas fa-star"></i>
                   <i class="fas fa-star"></i>
                   <i class="fas fa-star"></i>
                   <i class="fas fa-star-half-alt"></i>
                </div>
             </div>
          </div>
       </div>
 
       <div class="box">
          <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo fugiat, quaerat voluptate odio consectetur assumenda fugit maxime unde at ex?</p>
          <div class="user">
             <img src="{{('assets/images/pic-4.jpg')}}" alt="">
             <div>
                <h3>Unknown</h3>
                <div class="stars">
                   <i class="fas fa-star"></i>
                   <i class="fas fa-star"></i>
                   <i class="fas fa-star"></i>
                   <i class="fas fa-star"></i>
                   <i class="fas fa-star-half-alt"></i>
                </div>
             </div>
          </div>
       </div>
    </div>
 
 </section>

@endsection