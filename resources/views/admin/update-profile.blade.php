@extends('admin.layouts.header-nav')
@section('title', 'update-profile')
@section('content')

    <section class="form-container" style="min-height: calc(100vh - 19rem);">


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

        <form class="register" action="{{ route('update-profile', $current_profile['0']->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <h3>update profile</h3>
            <div class="flex">
                <div class="col">
                    <p>your name </p>
                    <input type="text" name="name" value="{{ $current_profile['0']->name }}" maxlength="50"
                        class="box @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <p>your profession </p>
                    <select name="profession" class="box @error('profession') is-invalid @enderror">
                        <option value="{{ $current_profile['0']->profession }}" selected>
                            {{ $current_profile['0']->profession }}</option>
                        <option value="developer">developer</option>
                        <option value="desginer">desginer</option>
                        <option value="musician">musician</option>
                        <option value="biologist">biologist</option>
                        <option value="teacher">teacher</option>
                        <option value="engineer">engineer</option>
                        <option value="lawyer">lawyer</option>
                        <option value="accountant">accountant</option>
                        <option value="doctor">doctor</option>
                        <option value="journalist">journalist</option>
                        <option value="photographer">photographer</option>
                    </select>
                    @error('profession')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <p>your email </p>
                    <input type="email" name="email" value="{{ $current_profile[0]->email }}" placeholder=""
                        class="box @error('email') is-invalid @enderror">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="col">
                    <p>old password :</p>
                    <input type="password" name="old_password" placeholder="enter your old password" maxlength="20"
                        class="box @error('old_password') is-invalid @enderror">
                    @error('old_pass')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <p>new password :</p>
                    <input type="password" name="password" placeholder="enter your new password" maxlength="20"
                        class="box @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <p>confirm password :</p>
                    <input type="password" name="password_confirmation" placeholder="confirm your new password"
                        maxlength="20" class="box @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <p>update pic :</p>
            <input type="file" name="image" accept="image/*" class="box @error('image') is-invalid @enderror">
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="submit" name="submit" value="update now" class="btn">
        </form>

    </section>
@endsection
