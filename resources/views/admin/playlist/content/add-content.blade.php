@extends('admin.layouts.header-nav')
@section('title', 'Upload New Content')
@section('content')
    <style>
        .bar {
            background-color: #00ff00;
        }

        .percent {
            position: relative;
            left: 50%;
            color: black;
        }
    </style>

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
        <h1 class="heading">upload content</h1>

        <form action="{{ route('add-content', ['id' => $id]) }}" id="fileUploadForm" method="post"
            enctype="multipart/form-data">
            @csrf
            <p>video status <span>*</span></p>
            <select name="status" class="box @error('status') is-invalid @enderror" required>
                <option value="" selected disabled>-- select status</option>
                <option value="1">active</option>
                <option value="0">deactive</option>
            </select>
            @error('status')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <p>video title <span>*</span></p>
            <input type="text" name="title" maxlength="100" required placeholder="enter video title"
                class="box @error('title') is-invalid @enderror">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <p>video description <span>*</span></p>
            <textarea name="description" class="box @error('description') is-invalid @enderror" required
                placeholder="write description" maxlength="1000" cols="30" rows="10"></textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <p>video playlist <span>*</span></p>
            <select name="playlist" class="box @error('playlist') is-invalid @enderror" required>
                <option value="" disabled selected>--select playlist</option>
                @foreach ($playlist as $name)
                    @if ($id == $name->id)
                        <option value="{{ $name->id }}" selected>{{ $name->title }}</option>
                    @else
                        <option value="{{ $name->id }}">{{ $name->title }}</option>
                    @endif
                @endforeach

            </select>
            @error('playlist')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <p>select thumbnail <span>*</span></p>
            <input type="file" name="thumb" accept="image/*" required class="box @error('thumb') is-invalid @enderror">
            @error('thumb')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <p>select video <span>*</span></p>
            <input type="file" name="video" id="video" accept="video/*" required
                class="box @error('video') is-invalid @enderror">
            @error('video')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="box">
                <div class="bar"></div>
                <div class="percent">0%</div>
            </div>

            <input type="submit" value="upload video" name="submit" class="btn">
        </form>

    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>

    {{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const uploadForm = document.getElementById('fileUploadForm');
        const videoSize = document.getElementById('video');
        const uploadAnimation = document.getElementById('upload-animation');
        const progressBar = document.getElementById('progress-bar');

        uploadForm.addEventListener('submit', function (e) {
            e.preventDefault();
            uploadAnimation.style.display = 'block';
            simulateUpload(); // Simulate the upload process
        });

        function simulateUpload() {
            let progress = 0;
            const duration = 3000; // Duration of the simulated upload in milliseconds (adjust as needed)
            const interval = 20; // Update interval for the progress bar

            const increment = (interval / duration) * 100;

            const uploadInterval = setInterval(function () {
                progress += increment;
                progressBar.style.width = progress + '%';

                if (progress >= 100) {
                    clearInterval(uploadInterval);
                    uploadForm.submit(); // Submit the form when the upload is "complete"
                    uploadAnimation.style.display = 'none'; // Hide the animation
                }
            }, interval);
        }
    });
</script> --}}

    <script>
        $(document).ready(function() {
            var bar = $('.bar');
            var percent = $('.percent');

            $('form').ajaxForm({
                beforeSend: function() {
                    var percentVal = '0%';
                    bar.width(percentVal);
                    percent.html(percentVal);
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentVal = percentComplete + '%';
                    bar.width(percentVal);
                    percent.html(percentVal);
                },

                complete: function() {
                    alert('File Uploaded..');
                    window.location.href= {{ url('/admin/view-playlist/') }};
                }

            });
        });
    </script>
@endsection
