<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="{{asset('assets/css/admin_style.css')}}">

</head>

<body>

   @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{-- 
   <section class="form-container">

      <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
         @csrf
         <h3>register now</h3>
         <p>your name <span>*</span></p>
         <input type="text" class="box @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="enter your name" required maxlength="50">
         @error('name')
            <span class="invalid-feedback" role="alert">
               <strong style="color: red">{{ $message }}</strong>
            </span>
         @enderror

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

         <p>confirm password <span>*</span></p>
         <input type="password" id="password-confirm" name="password_confirmation" placeholder="confirm your password" required maxlength="20" class="box @error('password') is-invalid @enderror">
         @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
               <strong style="color: red">{{ $message }}</strong>
            </span>
         @enderror

         <p>select profile <span>*</span></p>
         <input type="file" accept="image/*" name="profile" value="{{ old('profile') }}" required class="box @error('profile') is-invalid @enderror">
         <input type="submit" value="register new" name="submit" class="btn">
         @error('profile')
            <span class="invalid-feedback" role="alert">
               <strong style="color: red">{{ $message }}</strong>
            </span>
         @enderror

      </form>

   </section> --}}

   <section class="form-container">

      <form class="register" action="{{ route('register') }}" method="post" enctype="multipart/form-data">
         @csrf
         <h3>register new</h3>
         <div class="flex">
            <div class="col">
               <p>your name <span>*</span></p>
               <input type="text" name="name" value="{{ old('name') }}" placeholder="enter your name" maxlength="50" required class="box @error('name') is-invalid @enderror">
               @error('name')
                  <span class="invalid-feedback" role="alert">
                     <strong style="color: red">{{ $message }}</strong>
                  </span>
               @enderror
               
               <p>your profession <span>*</span></p>
               <select name="profession" value="{{ old('profession') }}" class="box @error('profession') is-invalid @enderror" required>
                  <option value="" disabled>-- select your profession</option>
                  @php
                      $profession = DB::table('professions')->get();
                  @endphp
                  @foreach ($profession as $prof)
                     <option value="{{ $prof->name }}">{{ $prof->name }}</option>
                  @endforeach
               </select>
               @error('profession')
                  <span class="invalid-feedback" role="alert">
                     <strong style="color: red">{{ $message }}</strong>
                  </span>
               @enderror
              
               <p>your email <span>*</span></p>
               <input type="email" name="email" value="{{ old('email') }}" placeholder="enter your email"  required class="box  @error('email') is-invalid @enderror">
            </div>
            @error('email')
               <span class="invalid-feedback" role="alert">
                  <strong style="color: red">{{ $message }}</strong>
               </span>
            @enderror
           
            <div class="col">
               <p>your password <span>*</span></p>
               <input type="password" name="password" value="{{ old('password') }}" placeholder="enter your password" maxlength="20" required class="box  @error('password') is-invalid @enderror">
               @error('password')
                  <span class="invalid-feedback" role="alert">
                     <strong style="color: red">{{ $message }}</strong>
                  </span>
               @enderror
               
               <p>confirm password <span>*</span></p>
               <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="confirm your password" maxlength="20" required class="box  @error('password_confirmation') is-invalid @enderror">
               @error('password_confirmation')
                  <span class="invalid-feedback" role="alert">
                     <strong style="color: red">{{ $message }}</strong>
                  </span>
               @enderror
               
               <p>select pic <span>*</span></p>
               <input type="file" name="profile" accept="image/*" value="{{ old('image') }}" required class="box  @error('image') is-invalid @enderror">
               @error('profile')
                  <span class="invalid-feedback" role="alert">
                     <strong style="color: red">{{ $message }}</strong>
                  </span>
               @enderror
            </div>
         </div>
         
         <p class="link">already have an account? <a href="{{ route('login') }}">login now</a></p>
         <input type="submit" name="submit" value="register now" class="btn">
      </form>
   
   </section>
   <!-- custom js file link  -->
   <script src="{{asset('assets/js/script.js')}}"></script>


</body>

</html>