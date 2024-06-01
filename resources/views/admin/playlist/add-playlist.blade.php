@extends('admin.layouts.header-nav')
@section('title', 'Add Playlist')
@section('content')
    <section class="playlist-form">

        @if (session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        @endif

        <h1 class="heading">create playlist</h1>

        <form action="{{ route('add_post') }}" method="post" enctype="multipart/form-data">
            @csrf
            <p>playlist status <span>*</span></p>
            <select name="status" class="box @error('status') is-invalid @enderror" required>
                <option value="" selected disabled>-- select status</option>
                <option value="1">active</option>
                <option value="0">deactive</option>
            </select>
            @error('status')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <p>playlist title <span>*</span></p>
            <input type="text" name="title" maxlength="100" required placeholder="enter playlist title"
                class="box @error('title') is-invalid @enderror">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <p>playlist category <span>*</span></p>
            <select name="category" class="box @error('category') is-invalid @enderror" required>
                <option value="" selected disabled>-- select category</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <p>playlist description <span>*</span></p>
            <textarea name="description" class="box @error('description') is-invalid @enderror" required
                placeholder="write description" maxlength="1000" cols="30" rows="10"></textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <p>playlist thumbnail <span>*</span></p>
            <input type="file" name="thumb" accept="image/*" required class="box @error('thumb') is-invalid @enderror">
            @error('thumb')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <input type="submit" value="create playlist" name="submit" class="btn">
        </form>

    </section>

@endsection
