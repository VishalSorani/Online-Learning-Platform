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
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>

<body>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
    <section class="form-container">
     
        <form action="{{ route('password.email') }}" method="post" enctype="multipart/form-data" class="login">
            @csrf
           
            <h3>Reset Password</h3>
            <p>Email Address <span>*</span></p>
            <input type="email" id="email" name="email" placeholder="enter your email" autocomplete="email"
                autofocus value="{{ old('email') }}" required class="box @error('email') is-invalid @enderror"
                value="{{ old('email') }}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong style="color: red">{{ $message }}</strong>
                </span>
            @enderror


            <input type="submit" name="submit" value="Send Password Reset Link" class="btn">
        </form>

    </section>


    <!-- custom js file link  -->
    <script src="{{ asset('assets/js/script.js') }}"></script>


</body>

</html>
