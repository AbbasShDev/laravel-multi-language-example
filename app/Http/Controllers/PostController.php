<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class PostController extends Controller {

    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->get();

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return  view('posts.create');
    }

    public function store(Request $request)
    {
        $attrRoles = [];

        foreach (config('locales.languages') as $key => $val){
            $attrRoles['title.'.$key] = 'required';
            $attrRoles['body.'.$key] = 'required';
        }


        $attributes = $request->validate($attrRoles);

        $data['title'] = $request->title;
        $data['body'] = $request->body;

        $post = Post::create($data);

        return redirect()->to(route('posts.show', $post));

    }


    public function show($post)
    {
        $post = Post::where('slug->' . app()->getLocale(), $post)->first();

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
