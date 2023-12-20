<!doctype html>
<html lang="en">

<head>
    @extends('head')
</head>

<body>

    <div class="container" style="margin-top: 50px;">

        <a href="/" class="btn btn-outline-success">View all</a>

        <div class="row">


            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <h3 class="text-center text-danger"><b>Add New Post</b> </h3>
                <div class="form-group">
                    <form action="/post" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="name" class="form-control m-2" placeholder="name">
                        <Textarea name="description" cols="20" rows="4" class="form-control m-2" placeholder="description"></Textarea>
                        <label class="m-2">Cover Image</label>
                        <input type="file" id="input-file-now-custom-3" class="form-control m-2" name="cover">

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
