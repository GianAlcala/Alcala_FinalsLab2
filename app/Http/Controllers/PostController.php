<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
   // PostController.php

public function index()
{
    $posts = Post::where('PostArchived', false)->get();

    return view('posts.index', compact('posts'));
}


    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'PostName' => 'required|string',
            'PostImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $post = new Post();
        $post->PostName = $request->input('PostName');
        $post->PostArchived = false; // Set to false by default
    
        // Handle image upload
        $imagePath = $request->file('PostImage')->store('post_images', 'public');
        $post->PostImage = $imagePath;
    
        $post->save();
    
        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'PostName' => 'required|string',
            'PostImage' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'PostArchived' => 'boolean', // New field
        ]);

        $post->PostName = $request->input('PostName');
        $post->PostArchived = $request->input('PostArchived', false);

        // Handle image update
        if ($request->hasFile('PostImage')) {
            // Delete old image
            Storage::disk('public')->delete($post->PostImage);

            // Upload new image
            $imagePath = $request->file('PostImage')->store('post_images', 'public');
            $post->PostImage = $imagePath;
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    // PostController.php

public function destroy(Post $post)
{
    if (!$post->PostArchived) {
        $post->update(['PostArchived' => true]);
        return redirect()->route('posts.index')->with('success', 'Post archived successfully.');
    }

    return redirect()->route('posts.index')->with('warning', 'Post is already archived.');
}


}
