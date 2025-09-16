<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function read_post()
    {
        $posts = Post::with('category_post')->latest()->get();
        return view('admin.read_post', compact('posts'));
    }

    public function add_post()
    {
        $categories = Category::all();
        return view('admin.add_post', compact('categories'));
    }

    public function create_post(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required',
            'tags' => 'nullable|string',
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('uploads/posts'), $imageName);

        $post = new Post();
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->image = $imageName;
        $post->description = $request->description;
        $post->tags = $request->tags;
        $post->save();

        return redirect()->route('read_post');
    }

    public function delete_post($id)
    {
        $post = Post::find($id);
        if ($post->image && file_exists(public_path('uploads/posts/'.$post->image))) {
            unlink(public_path('uploads/posts/'.$post->image));
        }
        $post->delete();
        return redirect()->route('read_post');
    }

    public function edit_post($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('admin.edit_post', compact('post','categories'));
    }

    public function update_post(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required',
            'tags' => 'nullable|string',
        ]);

        $post = Post::find($id);

        $imageName = $post->image;
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('uploads/posts'), $imageName);
        }

        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->image = $imageName;
        $post->description = $request->description;
        $post->tags = $request->tags;
        $post->save();

        return redirect()->route('read_post');
    }
}
