<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin_style.css') }}">
</head>

<body>
    {{-- <header class="header">

        <section class="flex">

            <a href="/admin/dashboard" class="logo">Educa.</a>

            <form action="search.html" method="post" class="search-form">
                <input type="text" name="search_box" required placeholder="search courses..." maxlength="100">
                <button type="submit" class="fas fa-search"></button>
            </form>

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="search-btn" class="fas fa-search"></div>
                <div id="user-btn" class="fas fa-user"></div>
                <div id="toggle-btn" class="fas fa-sun"></div>
            </div>

            <div class="profile">
                <img src="{{ asset('/Profile/' . Auth::user()->profile) }}" class="image" alt="">
                <h3 class="name">{{ auth()->user()->name }}</h3>
                <p class="role">
                    @if (Auth::user()->user_type == 0)
                        Student
                    @else
                        Admin
                    @endif
                </p>
                <a href="profile.html" class="btn">view profile</a>
                @if (Auth::guest())
                    <a href="/login" class="option-btn">login</a>
                    <a href="/register" class="option-btn">register</a>
                @else
                    <a href="/logout" class="option-btn">logout</a>
                @endif
            </div>

        </section>

    </header> --}}
    <header class="header">
        <section class="flex">
            <a href="#" class="logo">Admin.</a>

            <form action="{{ '/admin/search' }}" method="post" class="search-form">
                @csrf
                <input type="text" name="search" placeholder="search here..." required maxlength="100">
                <button type="submit" class="fas fa-search" name="search_btn"></button>
            </form>

            <div class="icons">
                <div id="menu-btn" class="fas fa-bars"></div>
                <div id="search-btn" class="fas fa-search"></div>
                <div id="user-btn" class="fas fa-user"></div>
                <div id="toggle-btn" class="fas fa-sun"></div>
            </div>

            <div class="profile">
                <img src="{{ asset('Profile/' . Auth()->user()->profile) }}" alt="">
                <h3>{{ Auth()->user()->name }}</h3>
                <span>{{ Auth()->user()->profession }}</span>
                <a href="{{ '/admin/view-profile/' . auth()->user()->id }}" class="btn">view profile</a>
              
                @if (Auth::check())
                    {{-- <h3>please login or register</h3> --}}
                    <a href="/logout" onclick="return confirm('logout from this website?');"
                        class="delete-btn">logout</a>
                @else
                    <div class="flex-btn">
                        <a href="{{ route('login') }}" class="option-btn">login</a>
                        <a href="{{ route('register') }}" class="option-btn">register</a>
                    </div>
                @endif
            </div>
        </section>
    </header>

    {{-- <div class="side-bar">

        <div id="close-btn">
            <i class="fas fa-times"></i>
        </div>

        <div class="profile">
            <img src="{{ asset('/Profile/' . Auth::user()->profile) }}" class="image" alt="">
            <h3 class="name">{{ auth()->user()->name }}</h3>
            <p class="role">
                @if (Auth::user()->user_type == 0)
                    Student
                @else
                    Admin
                @endif
            </p>
            <a href="profile.html" class="btn">view profile</a>
        </div>

        <nav class="navbar">
            <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}"><i
                    class="fas fa-home"></i><span>home</span></a>
            <a href="/admin/about" class="{{ request()->is('admin/about') ? 'active' : '' }}"><i
                    class="fas fa-question"></i><span>about</span></a>
            <a href="/admin/courses" class="{{ request()->is('admin/courses*') ? 'active' : '' }}"><i
                    class="fas fa-graduation-cap"></i><span>courses</span></a>
            <a href="teachers.html" class="{{ request()->is('admin/') ? 'active' : '' }}"><i
                    class="fas fa-chalkboard-user"></i><span>teachers</span></a>
            <a href="contact.html" class="{{ request()->is('admin/') ? 'active' : '' }}"><i
                    class="fas fa-headset"></i><span>contact us</span></a>
        </nav>

    </div> --}}


    <div class="side-bar">
        <div class="close-side-bar">
            <i class="fas fa-times"></i>
        </div>

        <div class="profile">
            <img src="{{ asset('Profile/' . Auth()->user()->profile) }}" alt="">
            <h3>{{ Auth()->user()->name }}</h3>
            <span>{{ Auth()->user()->profession }}</span>
            <a href="{{ '/admin/view-profile/' . auth()->user()->id }}" class="btn">view profile</a>

            @if (!Auth::check())
                <h3>please login or register</h3>
                <div class="flex-btn">
                    <a href="login.php" class="option-btn">login</a>
                    <a href="register.php" class="option-btn">register</a>
                </div>
            @endif


        </div>

        <nav class="navbar">
            <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard*') ? 'active' : '' }}"><i
                    class="fas fa-home"></i><span>home</span></a>

            <a href="/admin/playlist"
                class="{{ request()->is('admin/playlist*') || request()->is('admin/view-playlist*') ? 'active' : '' }}"><i
                    class="fa-solid fa-bars-staggered"></i><span>playlists</span></a>

            <a href="/admin/playlist/content"
                class="{{ request()->is('admin/playlist/content*') ? 'active' : '' }}"><i
                    class="fas fa-graduation-cap"></i><span>contents</span></a>

            <a href="{{ route('comment-admin') }}" class="{{ request()->is('admin/comments*') ? 'active' : '' }}"><i
                    class="fas fa-comment"></i><span>comments</span></a>

            @if (Auth::check())
                <a href="/home" onclick="return confirm('You want to move home?');"><i
                        class="fas fa-eye"></i><span>web site</span></a>

                <a href="/logout" onclick="return confirm('logout from this website?');"><i
                        class="fas fa-right-from-bracket"></i><span>logout</span></a>
            @endif

            @if (Auth::user()->user_type == '2')
                <a href="/admin/request/tutors/"><i
                    class="fas fa-list"></i><span>Tutor Request</span></a>
            @endif
        </nav>

    </div>



    @yield('content')

    <footer class="footer">

        &copy; copyright @ 2022 by <span>mr. web designer</span> | all rights reserved!

    </footer>

    <!-- custom js file link  -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>


    </script>
</body>

</html>
