<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts  = Post::all();
        return view('index', [
            'title' => 'TO DO LIST APP',
        ])->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile("cover")) {
            $file = $request->file('cover');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(\public_path("cover/"), $imageName);

            $post = new Post([
                "name" => $request->name,
                "description" => $request->description,
                "cover" => $imageName,
            ]);
            $post->save();
        }

        if ($request->hasFile("images")) {
            $files = $request->file('images');
            foreach ($files as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $request['post_id'] = $post->id;
                $request['image'] = $imageName;
                $file->move(\public_path("/images"), $imageName);
                Image::create($request->all());
            }
        }

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Post::findOrFail($id);
        return view('edit', ['title' => 'Edit' . $posts->name])->with('posts', $posts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        if ($request->hasFile('cover')) {
            if (File::exists("cover/" . $post->cover)) {
                File::delete("cover/" . $post->cover);
            }
            $file = $request->file('cover');
            $post->cover = time() . '_' . $file->getClientOriginalName();
            $file->move(\public_path("/cover"), $post->cover);
            $request['cover'] = $post->cover;
        }

        $post->update([
            'name' => $request->name,
            'description' => $request->description,
            'cover' => $post->cover
        ]);

        if ($request->hasFile("images")) {
            $files = $request->file("images");
            foreach ($files as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $request["post_id"] = $id;
                $request["image"] = $imageName;
                $file->move(\public_path("images"), $imageName);
                Image::create($request->all());
            }
        }
        return redirect("/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Post::findOrFail($id);
        if (File::exists("cover/" . $posts->cover)) {
            File::delete("cover/" . $posts->cover);
        }

        $images = Image::where("post_id", $posts->id)->get();
        foreach ($images as $image) {
            if (File::exists("images/" . $image->image)) {
                File::delete("images/" . $image->image);
            }
        }
        $posts->delete();
        $images->delete();
        return back();
    }

    public function deleteImage($id)
    {
        $images = Image::findOrFail($id);
        if (File::exists("images/" . $images->image)) {
            File::delete("images/" . $images->image);
        }
        Image::find($id)->delete();
        return back();
    }

    public function deleteCover($id)
    {
        $posts = Post::findOrFail($id);
        if (File::exists("cover/" . $posts->cover)) {
            File::delete("cover/" . $posts->cover);
        }
        return back();
    }
}
