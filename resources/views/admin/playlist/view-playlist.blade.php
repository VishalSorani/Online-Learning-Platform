@extends('admin.layouts.header-nav')
@section('title', 'Playlists')
@section('content')
    <section class="playlists">

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
                <button type="button" class="closebtn" data-bs-dismiss="alert"
                    onclick="this.parentElement.style.display='none';" aria-label="Close">X</button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-warning">
                {{ session('error') }}
                <button type="button" class="closebtn" data-bs-dismiss="alert"
                    onclick="this.parentElement.style.display='none';" aria-label="Close">X</button>
            </div>
        @endif

        <h1 class="heading">added playlists</h1>

        <div class="box-container">

            <div class="box" style="text-align: center;">
                <h3 class="title" style="margin-bottom: .5rem;">create new playlist</h3>
                <a href="/admin/playlist/add-playlist" class="btn">add playlist</a>
            </div>
            @if (count($playlist) > 0)
                @foreach ($playlist as $item)
                    <div class="box">
                        <div class="flex">
                            @if ($item->status == 1)
                                <div><i class="fas fa-circle-dot" style="color:limegreen"></i><span
                                        style="color:limegreen">Active</span></div>
                            @else
                                <div><i class="fas fa-circle-dot" style="color:red"></i><span
                                        style="color:red">Deactive</span></div>
                            @endif
                            <div><i class="fas fa-calendar"></i><span>{{ $item->created_at->toDateString() }}</span></div>
                        </div>
                        <div class="thumb">

                            @php
                                $count = DB::table('contents')
                                    ->where('playlist_id', $item->id)
                                    ->count();
                            @endphp
                            <span>{{ $count }}</span>
                            <img src="{{ asset('/Thumbnails/playlist/' . $item->thumb) }}" alt="">
                        </div>
                        <h3 class="title">{{ $item->title }}</h3>
                        <p class="description">{{ substr($item->description, 0, 100) }}...</p>
                        <form action="{{ route('delete-playlist', ['id' => $item->id]) }}" method="post" class="flex-btn">
                            @csrf
                            <input type="hidden" name="playlist_id" value="id">
                            <a href="{{ '/admin/playlist/update-playlist/' . $item->id }}" class="option-btn">update</a>
                            @if ($item->soft_delete == 0)
                                <input type="submit" value="delete" class="delete-btn"
                                    onclick="return confirm('delete this playlist?');" name="delete">
                            @else
                                <input type="submit" value="restore" class="restore-btn"
                                    onclick="return confirm('Restore this playlist?');" name="restore">
                            @endif

                        </form>
                        <a href="{{ '/admin/view-playlist/' . $item->id }}" class="btn">view playlist</a>
                    </div>
                @endforeach
            @else
                <p class="not-found">No playlist added yet...!!! <a href="/admin/playlist/add-playlist" class="btn"
                        style="margin-top: 1.5rem;">add playlist</a></p>
            @endif

        </div>

    </section>



    {{-- Deleted Playlists --}}
    <section class="playlists">

        <h1 class="heading">deleted playlists</h1>
        @php
            $deleted_playlist = DB::table('playlists')
                ->where('soft_delete', '1')
                ->get();
        @endphp
        <div class="box-container">
            @if (count($deleted_playlist) > 0)
                @foreach ($deleted_playlist as $item)
                    <div class="box">
                        <div class="flex">
                            @if ($item->status == 1)
                                <div><i class="fas fa-circle-dot" style="color:limegreen"></i><span
                                        style="color:limegreen">Active</span></div>
                            @else
                                <div><i class="fas fa-circle-dot" style="color:red"></i><span
                                        style="color:red">Deactive</span></div>
                            @endif
                            <div><i class="fas fa-calendar"></i><span>
                                    {{ date('Y-m-d', strtotime($item->created_at)) }}</span></div>
                        </div>
                        <div class="thumb">

                            @php
                                $count = DB::table('contents')
                                    ->where('playlist_id', $item->id)
                                    ->count();
                            @endphp
                            <span>{{ $count }}</span>
                            <img src="{{ asset('/Thumbnails/playlist/' . $item->thumb) }}" alt="">
                        </div>
                        <h3 class="title">{{ $item->title }}</h3>
                        <p class="description">{{ substr($item->description, 0, 100) }}...</p>
                        <form action="{{ route('delete-playlist', ['id' => $item->id]) }}" method="post" class="flex-btn">
                            @csrf
                            <input type="hidden" name="playlist_id" value="id">
                            <a href="{{ '/admin/playlist/update-playlist/' . $item->id }}" class="option-btn">update</a>
                            @if ($item->soft_delete == 0)
                                <input type="submit" value="delete" class="delete-btn"
                                    onclick="return confirm('delete this playlist?');" name="delete">
                            @else
                                <input type="submit" value="restore" class="restore-btn"
                                    onclick="return confirm('Restore this playlist?');" name="restore">
                            @endif

                        </form>
                        <a href="{{ '/admin/view-playlist/' . $item->id }}" class="btn">view playlist</a>
                    </div>
                @endforeach
            @else
                <p class="not-found">No playlist deleted yet...!!! </p>
            @endif

        </div>

    </section>
@endsection
