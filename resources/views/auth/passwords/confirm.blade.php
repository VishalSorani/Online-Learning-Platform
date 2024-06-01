<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Reset Password</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

</head>

<body>


   
<section class="form-container">
    {{ __('Please confirm your password before continuing.') }}
   <form action="{{ route('password.confirm') }}" method="post" enctype="multipart/form-data" class="login">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">
      <h3>Reset Password</h3>
      
      <p>Password <span>*</span></p>
      <input type="password" id="password" name="password" autocomplete="current-password" placeholder="enter your password" maxlength="20"  required class="box @error('password') is-invalid @enderror">
      @error('password')
            <span class="invalid-feedback" role="alert">
               <strong style="color: red">{{ $message }}</strong>
            </span>
         @enderror
      
      <input type="submit" name="submit" value="Confirm Password" class="btn">
      @if (Route::has('password.request'))
      <a class="btn btn-link" href="{{ route('password.request') }}">
          {{ __('Forgot Your Password?') }}
      </a>
  @endif
   </form>

</section>


   <!-- custom js file link  -->
   <script src="{{asset('assets/js/script.js')}}"></script>


</body>

</html>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Confirm Password') }}</div>

                <div class="card-body">
                    {{ __('Please confirm your password before continuing.') }}

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Confirm Password') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

