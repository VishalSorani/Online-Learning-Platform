@extends('admin.layouts.header-nav')
@section('title', 'All Courses')
@section('content')
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <section class="courses">
        <h1 class="heading">our courses</h1>
        <div style="margin-bottom: 2rem;">
            <a href="/admin/courses/add-course" class="inline-btn">Add New Course</a>
        </div>

        <div class="box-container">
            <div class="box">
                <div class="tutor">
                    <img src="images/pic-2.jpg" alt="">
                    <div class="info">
                        <h3>john deo</h3>
                        <span>21-10-2022</span>
                    </div>
                </div>
                <div class="thumb">
                    <img src="images/thumb-1.png" alt="">
                    <span>10 videos</span>
                </div>
                <h3 class="title">complete HTML tutorial</h3>
                <a href="playlist.html" class="inline-btn">view playlist</a>
            </div>

            <div class="box">
                <div class="tutor">
                    <img src="images/pic-3.jpg" alt="">
                    <div class="info">
                        <h3>john deo</h3>
                        <span>21-10-2022</span>
                    </div>
                </div>
                <div class="thumb">
                    <img src="images/thumb-2.png" alt="">
                    <span>10 videos</span>
                </div>
                <h3 class="title">complete CSS tutorial</h3>
                <a href="playlist.html" class="inline-btn">view playlist</a>
            </div>

            <div class="box">
                <div class="tutor">
                    <img src="images/pic-4.jpg" alt="">
                    <div class="info">
                        <h3>john deo</h3>
                        <span>21-10-2022</span>
                    </div>
                </div>
                <div class="thumb">
                    <img src="images/thumb-3.png" alt="">
                    <span>10 videos</span>
                </div>
                <h3 class="title">complete JS tutorial</h3>
                <a href="playlist.html" class="inline-btn">view playlist</a>
            </div>
        </div>

    </section>
@endsection
