<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @extends('head')
</head>

<body>
    <div class="container" style="margin-top: 50px;">

        <h3 class="text-center text-danger"><b>Laravel CRUD With Multiple Image Upload</b> </h3>
        <a href="/create" class="btn btn-outline-success">Add New Post</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Cover</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->name }}</td>
                        <td>{{ $post->description }}</td>
                        <td><img src="cover/{{ $post->cover }}" class=" img-responsive"
                                style=" max-height:100px; max-width:100px" alt="" srcset="" /></td>
                        <td>
                            <a href="/edit/{{ $post->id }}" class="btn btn-outline-primary ">Update</a>
                        </td>
                        <td>
                            <form action="/delete/{{ $post->id }}" method="POST">
                                <button class="btn btn-outline-danger " type="submit"
                                    onclick="return confirm('Are you sure?');">Delete</button>

                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
