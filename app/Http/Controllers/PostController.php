<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Blog/Index', [
            'posts' => Post::with('author')->orderBy('created_at', 'desc')->get()->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'summary' => $post->summary . '...',
                    'published_at' => $post->published_at,
                    'author' => $post->author->name,
                    'slug' => $post->slug,
                    'user_liked' => auth()->check() ? $post->likes->contains(auth()->user()->id) : false,
                ];
            }),
        ]);
    }

    public function search(Request $request) {

        $posts = Post::where('title', 'like', '%' . $request->searchVal . '%')
            ->orderBy('created_at', 'desc')
            ->with('author')
            ->get()
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'summary' => $post->summary . '...',
                    'published_at' => $post->published_at,
                    'author' => $post->author->name,
                    'slug' => $post->slug,
                    'user_liked' => auth()->check() ? $post->likes->contains(auth()->user()->id) : false,
                ];
            });

        return json_encode($posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts|max:255',
            'content' => 'required',
        ], [
            'title.required' => 'The title field is required.',
            'slug.unique' => 'This slug is already taken.',
            'content.required' => 'The content field is required.',
        ]);

        $post = Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'published_at' => now(),
            'user_id' => auth()->user()->id,
        ]);

        return to_route('blog.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return Inertia::render('Blog/Show', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'published_at' => $post->published_at->format('jS F Y'),
                'read_time' => $post->read_time,
                'likes' => $post->likes->count(),
                'user_liked' => auth()->check() ? $post->likes->contains(auth()->user()->id) : false,
                'author' => $post->author->name,
                'slug' => $post->slug,
            ],
            'morePosts' => Post::where('id', '!=', $post->id)->with('author')->inRandomOrder()->limit(3)->get()->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'summary' => $post->summary . '...',
                    'published_at' => $post->published_at,
                    'author' => $post->author->name,
                    'slug' => $post->slug,
                    'user_liked' => auth()->check() ? $post->likes->contains(auth()->user()->id) : false,
                ];
            }),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function like() {
        $post = Post::find(request('post_id'));
        $post->likes()->toggle(auth()->user()->id);

        if ($post->likes->contains(auth()->user()->id)) {
            return true;
        } else {
            return false;
        }
    }
}
