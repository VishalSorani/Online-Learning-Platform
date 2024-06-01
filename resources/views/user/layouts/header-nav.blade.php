<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

</head>

<body>
    <header class="header">
        <section class="flex">
            <a href="{{ route('user-home') }}" class="logo">Educa.</a>
            
            <form action="{{ '/course/search' }}" method="post" class="search-form">
                @csrf
                <input type="text" value="" name="search" placeholder="search courses..." required maxlength="100">   
                <button type="submit" class="fas fa-search" name="search_course_btn"></button>
            </form>
            
            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="search-btn" class="fas fa-search"></div>
                <div id="user-btn" class="fas fa-user"></div>
                <div id="toggle-btn" class="fas fa-sun"></div>
            </div>
            <div class="profile">
                @if (Auth::check())
                    <img src="{{asset('Profile/'.Auth()->user()->profile)}}" alt="">
                    <h3>{{Auth()->user()->name}}</h3>
                    <span>{{ Auth()->user()->profession }}</span>
                    <a href="{{ route('profile',auth()->user()->id)}}" class="btn">view profile</a>
                    <a href="/logout" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
                @else
                    <h3>please login or register</h3>
                    <div class="flex-btn">
                        <a href="{{ route('login') }}" class="option-btn">login</a>
                        <a href="{{ route('register') }}" class="option-btn">register</a>
                    </div>
                @endif
            </div>
        </section>
    </header>
    <!-- header section ends -->

    <!-- side bar section starts  -->
    <div class="side-bar">
        <div class="close-side-bar">
            <i class="fas fa-times"></i>
        </div>
        <div class="profile">
            @if (Auth::check())
                <img src="{{asset('Profile/'.Auth()->user()->profile)}}" alt="">
                <h3>{{Auth()->user()->name}}</h3>
                <span>{{Auth()->user()->profession}}</span>
                <a href="{{ route('profile',auth()->user()->id)}}" class="btn">view profile</a>
            @else
                <h3>please login or register</h3>
                <div class="flex-btn">
                    <a href="{{ route('login') }}" class="option-btn">login</a>
                    <a href={{ route('register') }}" class="option-btn">register</a>
                </div>
            @endif
        </div>

        <nav class="navbar">
            <a href="{{ route('user-home') }}" class="{{ (request()->is('home*')) ? 'active' : '' }}"><i class="fas fa-home"></i><span>home</span></a>
            <a href="{{ route('about') }}" class="{{ (request()->is('about-us*')) ? 'active' : '' }}"><i class="fas fa-question"></i><span>about us</span></a>
            <a href="{{ route('course') }}" class="{{ (request()->is('courses*')) ? 'active' : '' }}"><i class="fas fa-graduation-cap"></i><span>courses</span></a>
            <a href="{{ route('tutors') }}" class="{{ (request()->is('tutors*')) ? 'active' : '' }}"><i class="fas fa-chalkboard-user"></i><span>teachers</span></a>
            <a href="{{ route('contact') }}" class="{{ (request()->is('contact-us')) ? 'active' : '' }}"><i class="fas fa-headset"></i><span>contact us</span></a>
            @if (Auth::check() && (Auth::user()->user_type == '1' || Auth::user()->user_type == '2'))
                <a href="{{ '/admin/dashboard' }}" onclick="return confirm('You want to move admin Dashboard?');" class=""><i class="fas fa-user"></i><span>Admin Dashboard</span></a>
            @endif
        </nav>
    </div>
    <!-- side bar section ends -->

    <!-- Main Content start -->
    @yield('main')
    <!-- Main Content end -->



    <!-- footer section starts  -->
    {{-- <footer class="footer">
        &copy; copyright @ <?= date('Y') ?> by <span>mr. web designer</span> | all rights reserved!
    </footer> --}}
    <!-- footer section ends -->

    <!-- custom js file link  -->
    <script src="{{asset('assets/js/script.js')}}"></script>

</body>

</html>
