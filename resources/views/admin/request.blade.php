@extends('admin.layouts.header-nav')
@section('title', 'Pending Request')
@section('content')

    <header>
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    </header>

    <section class="playlist">
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

        <h1 class="heading">Tutor Requests</h1>
        @if (count($tutors) > 0)
            @foreach ($tutors as $tutor)
                <div class="row" style="margin-bottom: 1rem">
                    <div class="col">
                        <form action="#" class="save-list">
                            <input type="hidden" name="list_id" value="">


                            @if ($tutor->status == '0')
                                <button type="submit" name="save_list" disabled><i class="fas fa-circle"
                                        style="color: red;"></i><span style="color: red;">Pending</span></button>
                            @endif


                        </form>
                        <div class="thumb details">
                            <h3>Tell about your self and Why you want to become a tutor?</h3>
                            {{-- <span>{{ $count_video }} videos</span> --}}
                            <p>{{ $tutor->description }}</p>
                        </div>
                    </div>
                    @php
                        $user = DB::table('users')
                            ->where('id', $tutor->user_id)
                            ->get();
                    @endphp
                    <div class="col">
                        <div class="tutor">
                            <img src="{{ '/Profile/' . $user['0']->profile }}" alt="">
                            <div>
                                <h3>{{ $user['0']->name }}</h3>
                                <span>{{ $user['0']->profession }}</span>
                            </div>
                        </div>
                        <div class="details">
                            <h3>Do you have any work experience in teaching field? If "Yes" then describe</h3>
                            <p>{{ $tutor->experience }}...</p>
                            <div class="date"><i
                                    class="fas fa-calendar"></i><span>{{ date('Y-m-d', strtotime($tutor->created_at)) }}</span>
                            </div>

                            {{-- @if (count($enroll) == 1) --}}
                            <a href="{{ '/admin/request/tutors/' . $tutor->user_id }}" class="inline-btn">Approve</a>
                            {{-- @else --}}
                            <a href="{{ '/admin/request/tutors/reject/' . $tutor->user_id }}" class="inline-btn">Reject</a>
                            {{-- @endif --}}
                        </div>
                    </div>

                </div>
            @endforeach
        @else
            <p class="empty">no request found yet!</p>
        @endif

        <div class="pagination">
            {!! $tutors->links('pagination::bootstrap-4') !!}
        </div>
    </section>
@endsection
