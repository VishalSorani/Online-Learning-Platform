@extends('admin.layouts.header-nav')
@section('title', 'Add New Course')
@section('content')
    <section class="form-container">

        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <h3>Course Details</h3>
            <p>Course Name</p>
            <input type="text" name="name" placeholder="Android" maxlength="50"
                class="box @error('title') is-invalid @enderror">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <p>Desscription</p>
            <textarea type="text" name="description" placeholder="Type Discription..."
                class="box @error('title') is-invalid @enderror"></textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <p>Thumbnail</p>
            <input type="file" accept="image/*" id="image" name="image"
                class="box @error('title') is-invalid @enderror" onchange="loadFile(event)">
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <img id="output" class="box" style="display: none" />
            <input type="submit" value="new course" name="submit" class="btn">
        </form>

    </section>

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            document.getElementById('output').style.display = "block";
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

@endsection
