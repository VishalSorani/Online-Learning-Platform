@extends('admin.layouts.header-nav')
@section('title', 'View Playlist Content')
@section('content')
    <section class="playlist-details">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
                <button type="button" class="closebtn" data-bs-dismiss="alert"
                    onclick="this.parentElement.style.display='none';" aria-label="Close">X</button>
            </div>
        @endif

        @foreach ($playlist as $item)
            <h1 class="heading">playlist details</h1>
            <div class="row">
                <div class="thumb">
                    @php
                        $count_content = DB::table('contents')
                            ->where('tutor_id', auth()->user()->id)
                            ->count();
                    @endphp
                    <span>{{ $count_content }}</span>
                    <img src="{{ asset('Thumbnails/playlist/' . $item->thumb) }}" alt="Thumbnail">
                </div>
                <div class="details">
                    <h3 class="title">{{ $item->title }}</h3>
                    <div class="date"><i class="fas fa-calendar"></i><span>{{ $item->created_at->toDateString() }}</span>
                    </div>
                    <div class="description">{{ substr($item->description, 0, 190) }}...</div>
                    @php
                        $enroll = DB::table('enrolls')
                            ->where('playlist_id', $item->id)
                            ->count();
                    @endphp
                    <div class="enroll"><span>{{ $enroll }} Enrollments 🎉</span></div>
                    <form action="" method="post" class="flex-btn">
                        <input type="hidden" name="playlist_id" value="{{ $item->id }}">
                        <a href="{{ '/admin/playlist/add-content/' . $item->id }}" class="option-btn">Add Video</a>
                        <input type="submit" style="visibility: collapse;" value="delete playlist" class="delete-btn"
                            onclick="return confirm('delete this playlist?');" name="delete">
                    </form>
                </div>
            </div>
        @endforeach
    </section>

    <section class="contents">

        <h1 class="heading">playlist videos</h1>

        <div class="box-container">
            @if (count($playlist_content) > 0)
                @foreach ($playlist_content as $content)
                    <div class="box">
                        <div class="flex">
                            @if ($content->status == 1)
                                <div><i class="fas fa-circle-dot" style="color:limegreen"></i><span
                                        style="color:limegreen">Active</span></div>
                            @else
                                <div><i class="fas fa-circle-dot" style="color:red"></i><span
                                        style="color:red">Deactive</span></div>
                            @endif
                            <div><i class="fas fa-calendar"></i><span>{{ $content->created_at->toDateString() }}</span>
                            </div>
                        </div>
                        <img src="{{ asset('/Thumbnails/playlist/thumb-content/' . $content->thumb) }}" class="thumb"
                            alt="Thumbnail">
                        <h3 class="title">{{ $content->title }}</h3>
                        <form action="{{ route('delete-content', ['id' => $content->id]) }}" method="post" class="flex-btn">
                            @csrf
                            <input type="hidden" name="playlist_id" value="id">
                            <a href="{{ '/admin/view-playlist/update/' . $content->id }}" class="option-btn">update</a>
                            @if ($content->soft_delete == 0)
                                <input type="submit" value="delete" class="delete-btn"
                                    onclick="return confirm('delete this video content?');" name="delete">
                            @else
                                <input type="submit" value="restore" class="restore-btn"
                                    onclick="return confirm('Restore this video content?');" name="restore">
                            @endif

                        </form>
                        <a href="{{ route('view-video-admin', ['playlist' => $item->slug, 'video' => $content->slug]) }}"
                            class="btn">watch video</a>
                    </div>
                @endforeach
            @else
                <p class="not-found">No videos added yet! <a href="{{ '/admin/playlist/add-content/' . $item->id }}"
                        class="btn" style="margin-top: 1.5rem;">add videos</a></p>
            @endif
        </div>

    </section>

@endsection
