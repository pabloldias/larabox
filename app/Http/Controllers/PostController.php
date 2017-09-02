<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Repositories\PostRepository;

class PostController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(PostRepository $postRepository) 
    {
        
        $posts = $postRepository->all();

        return view('posts.index', compact('posts'));
    }

    public function create() 
    {
        return view('posts.create');
    }

    public function store() 
    {
        $this->validate(request(), [
            'title' => 'required',
            'body' => 'required'
        ]);
        auth()->user()->publish(
            new Post(request(['title', 'body']))
        );
        return redirect()->home();
    }

    public function show(Post $post) 
    {
        return view('posts.show', compact('post'));
    }

}
