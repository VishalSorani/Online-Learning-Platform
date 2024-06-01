@extends('admin.layouts.header-nav')
@section('title', 'Update Playlist Content')
@section('content')
    <section class="video-form">
        @if (session('error'))
            <div class="alert alert-success">
                {{ session('error') }}
                <button type="button" class="closebtn" data-bs-dismiss="alert"
                    onclick="this.parentElement.style.display='none';" aria-label="Close">X</button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-warning">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h1 class="heading">update content</h1>
        @foreach ($old_content as $content)
            <form action="{{ route('update-content', ['id' => $content->id]) }}" id="fileUploadForm" method="post"
                enctype="multipart/form-data">
                @csrf
                <p>update status <span>*</span></p>
                <select name="status" class="box @error('status') is-invalid @enderror" required>
                    {{-- <option value="" disabled>-- select status</option> --}}
                    @if ($content->status == 1)
                        <option value="1" selected>active</option>
                        <option value="0">deactive</option>
                    @else
                        <option value="1">active</option>
                        <option value="0" selected>deactive</option>
                    @endif
                </select>
                @error('status')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <p>update title <span>*</span></p>
                <input type="text" name="title" maxlength="100" required placeholder="enter video title"
                    class="box @error('title') is-invalid @enderror" value="{{ $content->title }}">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <p>update description <span>*</span></p>
                <textarea name="description" class="box @error('description') is-invalid @enderror" required
                    placeholder="write description" maxlength="1000" cols="30" rows="10">{{ $content->description }}</textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <p>update playlist <span>*</span></p>
                <select name="playlist" class="box @error('playlist') is-invalid @enderror" required>
                    <option value="" disabled selected>--select playlist</option>
                    @foreach ($playlist as $name)
                        @if ($content->playlist_id == $name->id)
                            <option value="{{ $name->id }}" selected>{{ $name->title }}</option>
                        @else
                            <option value="{{ $name->id }}">{{ $name->title }}</option>
                        @endif
                    @endforeach

                </select>
                @error('playlist')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <img src="{{ asset('Thumbnails/playlist/thumb-content/' . $content->thumb) }}" alt="">
                <p>update thumbnail <span>*</span></p>
                <input type="file" name="thumb" accept="image/*" class="box @error('thumb') is-invalid @enderror">
                @error('thumb')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <video src="{{ asset('Thumbnails/playlist/video-content/' . $content->video) }}" controls></video>
                <p>update video <span>*</span></p>
                <input type="file" name="video" id="video" accept="video/*"
                    class="box @error('video') is-invalid @enderror">
                @error('video')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div id="upload-animation">
                    <div id="progress-bar"></div>
                </div>

                <input type="submit" value="Update Content" name="submit" class="btn">
            </form>
        @endforeach

    </section>

@endsection
