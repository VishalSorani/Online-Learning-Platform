@extends('user.layouts.header-nav')
@section('title', 'Contact Us')
@section('main')

    <section class="contact">

        @if ($errors->any())
            <div class="alert alert-warning">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


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

        <div class="row">

            <div class="image">
                <img src="{{ asset('assets/images/contact-img.svg') }}" alt="">
            </div>

            <form action="{{ route('contact') }}" method="post">
                @csrf
                <h3>get in touch</h3>
                <input type="text" placeholder="enter your name" required maxlength="100" name="name" class="box">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <input type="email" placeholder="enter your email" required maxlength="100" name="email" class="box">
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <input type="number" placeholder="enter your number" required
                    maxlength="10" name="number" class="box">
                @error('number')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <textarea name="msg" class="box" placeholder="enter your message" required cols="30" rows="10"
                    maxlength="1000"></textarea>
                @error('msg')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <input type="submit" value="send message" class="inline-btn" name="submit">
            </form>

        </div>

        <div class="box-container">

            <div class="box">
                <i class="fas fa-phone"></i>
                <h3>phone number</h3>
                <a href="tel:1234567890">123-456-7890</a>
                <a href="tel:1112223333">111-222-3333</a>
            </div>

            <div class="box">
                <i class="fas fa-envelope"></i>
                <h3>email address</h3>
                <a href="mailto:soranivishald@gmail.com">soranivishald@gmail.com</a>
                <a href="mailto:meetpatel@gmail.com">meetpatel@gmail.com</a>
            </div>

            <div class="box">
                <i class="fas fa-map-marker-alt"></i>
                <h3>office address</h3>
                <a href="#">Marwadi University, Rajkot, Gujarat - 360003</a>
            </div>


        </div>

    </section>
@endsection
