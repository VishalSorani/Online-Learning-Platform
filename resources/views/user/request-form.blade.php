@extends('user.layouts.header-nav')
@section('title', 'Registration for Tutor')
@section('main')

    <section class="form-container">
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
        @php
            $old_request = DB::table('teachers')
                ->where('user_id', Auth::user()->id)
                ->get();
        @endphp
        @if (count($old_request) > 0)
            <p id="demo" class="empty"></p>
            <script>
                // Set the date we're counting down to
                var countDownDate = new Date("{{ \Carbon\Carbon::parse($old_request['0']->created_at)->format('M j, Y H:i:s') }}")
                    .getTime();
                countDownDate += 3 * 24 * 60 * 60 * 1000;
        
                // Update the count down every 1 second
                var x = setInterval(function() {
        
                    // Get today's date and time
                    var now = new Date().getTime();
        
                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;
                    console.log(distance);
                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
                    // Display the result in the element with id="demo"
                    document.getElementById("demo").innerHTML =
                        "You already submit this form..! It's take 2-3 days for process...! Once it will approved you will get your Access...Thank You! Time Remains: " + days + "d " + hours + "h " +minutes + "m " + seconds + "s ";
                    // If the count down is finished, write some text
                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("demo").innerHTML = "Your Reques Has Been Not Processed at Please Contact to Owner";
                    }
                }, 1000);
            </script>
        @else
            <form class="register" action="{{ route('tutor-register') }}" method="post" enctype="multipart/form-data">
                @csrf
                <h3>Tutor Request Form</h3>
                <div class="flex">
                    <div class="col">
                        <p>Tell about your self and Why you want to become a tutor? <span>*</span></p>
                        <textarea name="description" placeholder="Describe..." required class="box @error('description') is-invalid @enderror"></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                        @enderror

                        <p>Do you have any work experience in teaching field? If "Yes" then describe<span>*</span></p>
                        <textarea name="experience" placeholder="Work Experience" required
                            class="box @error('experience') is-invalid @enderror"></textarea>
                        @error('experience')
                            <span class="invalid-feedback" role="alert">
                                <strong style="color: red">{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </div>
                <input type="submit" name="submit" value="Send Request" class="btn">
            </form>
        @endif
    </section>


    {{-- @php
    dd(\Carbon\Carbon::parse($old_request['0']->created_at)->format('M j, Y H:i:s'));
@endphp --}}

  
@endsection
