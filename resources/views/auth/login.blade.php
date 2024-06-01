<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

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

   <form action="{{ route('login') }}" method="post" enctype="multipart/form-data" class="login">
      @csrf
      <h3>welcome back!</h3>
      <p>your email <span>*</span></p>
      <input type="email" name="email" placeholder="enter your email"  value="{{ old('email') }}" required class="box @error('email') is-invalid @enderror" value="{{ old('email') }}">
      @error('email')
      <span class="invalid-feedback" role="alert">
         <strong style="color: red">{{ $message }}</strong>
      </span>
   @enderror
      
      <p>your password <span>*</span></p>
      <input type="password" name="password" placeholder="enter your password" maxlength="20" value="{{ old('password') }}" required class="box @error('password') is-invalid @enderror">
      @error('password')
            <span class="invalid-feedback" role="alert">
               <strong style="color: red">{{ $message }}</strong>
            </span>
         @enderror
      
      
         <p class="link">don't have an account? <a href="{{ route('register') }}">Register new</a></p>
         <p class="link">Password Forgot? <a href="{{ route('password.request') }}">Reset</a></p>
      <input type="submit" name="submit" value="login now" class="btn">
   </form>

</section>


   <!-- custom js file link  -->
   <script src="{{asset('assets/js/script.js')}}"></script>


</body>

</html>