@extends('admin.layouts.header-nav')
@section('title', 'Update Playlist')
@section('content')
    <section class="playlist-form">
        @if (session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
                <button type="button" class="closebtn" data-bs-dismiss="alert"
                    onclick="this.parentElement.style.display='none';" aria-label="Close">X</button>
            </div>
        @endif
        <h1 class="heading">update playlist</h1>

        @foreach ($old_playlist_info as $item)
            <form action="{{ '/admin/playlist/update-playlist/' . $item->id }}" method="post" enctype="multipart/form-data">
                {{-- <input type="hidden" name="old_image" value=""> --}}
                @csrf
                <p>playlist status <span>*</span></p>
                <select name="status" class="box" required>
                    @if ($item->status == 1)
                        <option value="1" selected>active</option>
                        <option value="0">deactive</option>
                    @else
                        <option value="1">active</option>
                        <option value="0" selected>deactive</option>
                    @endif
                </select>


                <p>playlist title <span>*</span></p>
                <input type="text" name="title" maxlength="100" required placeholder="enter playlist title"
                    value="{{ $item->title }}" class="box">

                <p>playlist category <span>*</span></p>
                <select name="category" class="box @error('category') is-invalid @enderror" required>
                    @foreach ($categories as $cat)
                        @if ($cat->name == $item->category)
                            <option value="{{ $cat->name }}" selected>{{ $cat->name }}</option>
                        @else
                            <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('category')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <p>playlist description <span>*</span></p>
                <textarea name="description" class="box" required placeholder="write description" maxlength="1000" cols="30"
                    rows="10">{{ $item->description }}</textarea>


                <p>playlist thumbnail <span>*</span></p>
                <div class="thumb">
                    <span>0</span>
                    <img src="{{ asset('Thumbnails/playlist/' . $item->thumb) }}" alt="">
                </div>
                <input type="file" name="updated_thumb" accept="image/*" class="box">


                <input type="submit" value="update playlist" name="submit" class="btn">
                <div class="flex-btn">
                    @if ($item->soft_delete == 0)
                        <input type="submit" value="delete" class="delete-btn"
                            onclick="return confirm('delete this playlist?');" disabled name="delete">
                    @else
                        <input type="submit" value="restore" class="restore-btn"
                            onclick="return confirm('Restore this playlist?');" disabled name="restore">
                    @endif

                    <a href="{{ '/admin/view-playlist/' . $item->id }}" class="option-btn">view playlist</a>
                </div>
            </form>
        @endforeach
    </section>
@endsection
