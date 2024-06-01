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

   {{-- <section class="form-container">

      <form action="{{ route('login') }}" method="post" enctype="multipart/form-data">
         @csrf
         <h3>Login now</h3>
         <p>your email <span>*</span></p>
         <input type="email" name="email" class="box @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="enter your email" required maxlength="50">
         @error('email')
            <span class="invalid-feedback" role="alert">
               <strong style="color: red">{{ $message }}</strong>
            </span>
         @enderror

         <p>your password <span>*</span></p>
         <input type="password" name="password" class="box @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="enter your password" required maxlength="20">
         @error('password')
            <span class="invalid-feedback" role="alert">
               <strong style="color: red">{{ $message }}</strong>
            </span>
         @enderror
      <input type="submit" value="login new" name="submit" class="btn">
    </form>

   </section> --}}

   
<section class="form-container">

   <form action="{{ route('password.update') }}" method="post" enctype="multipart/form-data" class="login">
      @csrf
      <input type="hidden" name="token" value="{{ $token }}">
      <h3>Reset Password</h3>
      <p>Email Address <span>*</span></p>
      <input type="email" id="email" name="email" placeholder="enter your email"  autocomplete="email" autofocus value="{{ $email ?? old('email') }}" required class="box @error('email') is-invalid @enderror" value="{{ old('email') }}">
      @error('email')
      <span class="invalid-feedback" role="alert">
         <strong style="color: red">{{ $message }}</strong>
      </span>
   @enderror
      
      <p>Password <span>*</span></p>
      <input type="password" id="password" name="password" autocomplete="new-password" placeholder="enter your password" maxlength="20"  required class="box @error('password') is-invalid @enderror">
      @error('password')
            <span class="invalid-feedback" role="alert">
               <strong style="color: red">{{ $message }}</strong>
            </span>
         @enderror
         
         <p>Confirm Password <span>*</span></p>
         <input type="password" id="password-confirm" name="password_confirmation" autocomplete="new-password"  maxlength="20"  required class="box @error('password') is-invalid @enderror">
         @error('password')
               <span class="invalid-feedback" role="alert">
                  <strong style="color: red">{{ $message }}</strong>
               </span>
            @enderror
      <input type="submit" name="submit" value="Reset Password" class="btn">
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
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}



