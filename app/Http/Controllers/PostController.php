<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
//        $this->authorizeResource(Post::class,'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with([
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $request->validate([
            'title' => 'bail|required|unique:posts|max:255',
        ]);
        $path = 'post-photos/avatar.png';
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('post-photos');
        }
        $post = Post::create([
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'photo' => $path,
            'short_content' => $request->short_content,
            'content' => $request->content,
        ]);

        if(isset($request->tags)){
            foreach ($request->tags as $tag){
                $post->tags()->attach($tag);
            }
        }
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show')->with([
            'post' => $post,
            'recently_posts' => Post::latest()->get()->except($post->id)->take(5),
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
//        Gate::authorize('update-post',$post);
        $this->authorize('update',$post);
        return view('posts.edit')->with(['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, Post $post)
    {
//        Gate::authorize('update-post',$post);
        $this->authorize('update',$post);
        $request->validate([
            'title' => 'bail|required|unique:posts,title,'.$post->id.',|max:255',
        ]);
        if ($request->hasFile('photo')) {
            if (isset($post->photo)){
                Storage::delete($post->photo);
            }

            $path = $request->file('photo')->store('post-photos');
        }
        $post->update([
            'title' => $request->title,
            'photo' => $path ?? $post->photo,
            'content' => $request->content,
            'short_content' => $request->short_content,
        ]);
        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
//        Gate::authorize('delete-post',$post);
        $this->authorize('delete',$post);
        if(isset($post->photo)){
            Storage::delete($post->photo);
        }
        $post->delete();
        return redirect()->route('posts.index');
    }
}
