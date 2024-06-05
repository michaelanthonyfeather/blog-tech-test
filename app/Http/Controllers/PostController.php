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
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'posts' => Post::with('author')->get()->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'summary' => $post->summary . '...',
                    'published_at' => $post->published_at,
                    'author' => $post->author->name,
                    'slug' => $post->slug,
                ];
            }),
        ]);
    }

    public function search(Request $request) {

        $posts = Post::where('title', 'like', '%' . $request->searchVal . '%')
            ->orWhere('content', 'like', '%' . $request->searchVal . '%')
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return Inertia::render('Blog/Show', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'published_at' => $post->published_at->format('jS F Y'),
                'read_time' => $post->read_time,
                'likes' => $post->likes->count(),
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
}
