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
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $attrRoles = [];

        foreach (config('locales.languages') as $key => $val) {
            $attrRoles['title.' . $key] = 'required';
            $attrRoles['body.' . $key] = 'required';
        }


        $attributes = $request->validate($attrRoles);

        $data['title'] = $request->title;
        $data['body'] = $request->body;

        $post = Post::create($data);

        if ($post) {
            return redirect()->to(route('posts.show', $post))->with([
                'message'    => __('posts.post_created_successfully'),
                'alert_type' => 'success',
            ]);
        }

        return redirect()->to(route('posts.index'))->with([
            'message'    => __('posts.something_went_wrong'),
            'alert_type' => 'danger',
        ]);

    }


    public function show($post)
    {
        $post = Post::where('slug->' . app()->getLocale(), $post)->first();

        return view('posts.show', compact('post'));
    }

    public function edit($post)
    {
        $post = Post::where('slug->' . app()->getLocale(), $post)->first();

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $post)
    {
        $attrRoles = [];

        foreach (config('locales.languages') as $key => $val) {
            $attrRoles['title.' . $key] = 'required';
            $attrRoles['body.' . $key] = 'required';
        }


        $attributes = $request->validate($attrRoles);

        $data['title'] = $request->title;
        $data['body'] = $request->body;

        $post = Post::where('slug->' . app()->getLocale(), $post)->first();

        $updated = $post->update($data);

        if ($updated){
            return redirect()->to(route('posts.show', $post))->with([
                'message'    => __('posts.post_updated_successfully'),
                'alert_type' => 'success',
            ]);
        }

        return redirect()->to(route('posts.show', $post))->with([
            'message'    => __('posts.something_went_wrong'),
            'alert_type' => 'danger',
        ]);
    }

    public function destroy($post)
    {
        $deleted = $post = Post::where('slug->' . app()->getLocale(), $post)->first()->delete();

        if ($deleted){
            return redirect()->to(route('posts.index'))->with([
                'message'    => __('posts.post_deleted_successfully'),
                'alert_type' => 'danger',
            ]);
        }

        return redirect()->to(route('posts.index'))->with([
            'message'    => __('posts.something_went_wrong'),
            'alert_type' => 'danger',
        ]);
    }
}
