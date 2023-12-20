<!doctype html>
<html lang="en">

<head>
    @extends('head')
</head>

<body>

    <div class="container" style="margin-top: 50px;">

        <a href="/" class="btn btn-outline-success">View all</a>

        <div class="row">


            <div class="col-lg-3">
                <p>Cover:</p>
                <form action="/deleteCover/{{ $posts->id }}" method="POST">
                    <button class="btn btn-danger">X</button>
                    @csrf
                    @method('delete')
                </form>
                <img src="/cover/{{ $posts->cover }}" class="img-responsive" style="max-height: 100px; max-width:100px"
                    alt srcset="" />

                <br />

                @if (count($posts->images) > 0)
                    <p>Images:</p>
                    @foreach ($posts->images as $image)
                        <form action="/deleteImage/{{ $image->id }}" method="POST">
                            <button class="btn btn-danger">X</button>
                            @csrf
                            @method('delete')
                        </form>
                        <img src="/images/{{ $image->image }}" class="img-responsive"
                            style="max-height: 100px; max-width:100px" alt srcset="" />
                    @endforeach

                @endif


            </div>
            <div class="col-lg-6">
                <h3 class="text-center text-danger"><b>Add New Post</b> </h3>
                <div class="form-group">
                    <form action="/update/{{$posts->id}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="text" name="name" class="form-control m-2" placeholder="name"
                            value="{{ $posts->name }}">
                        <Textarea name="description" cols="20" rows="4" class="form-control m-2" placeholder="description">{{ $posts->description }}</Textarea>
                        <label class="m-2">Cover Image</label>
                        <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="cover"
                            value="{{ $posts->cover }}">

                        <label class="m-2">Images</label>
                        <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="images[]"
                            multiple>

                        <button type="submit" class="btn btn-danger mt-3 ">Submit</button>
                    </form>
                </div>
            </div>
        </div>



</body>

</html>
