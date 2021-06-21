<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        $data = [
            'posts' => $posts
        ];

        return view('admin.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);
        
        $new_post_data= $request->all();

        //creiamo lo slug
        $new_slug = Str::slug($new_post_data['title'], '-');
        $base_slug = $new_slug;
        //controllo che non esista un post con questo slug.
        $post_with_existing_slug = Post::where('slug', '=', $new_slug)->first();
        $counter = 1;

        //se esiste tento con altri slug
        while($post_with_existing_slug) {
            //provo con un nuovo slug appendendole un counter
            $new_slug = $base_slug . '-' . $counter;
            $counter++;
            //se anche il nuovo slug esiste nel database, il while continua..
            $post_with_existing_slug = Post::where('slug', '=', $new_slug)->first();

        }

        //quando finalmente ho trovato uno slug libero, popoliamo i data da salvare 
        $new_post_data['slug'] = $new_slug;

        $new_post = new Post();
        $new_post->fill($new_post_data);
        $new_post->save();

        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        $data = [
            'post' => $post
        ];

        return view('admin.posts.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        $data = [
            'post' => $post
        ];

        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|max:65000',
        ]);

        $modified_post_data = $request->all();

        $post = Post::findOrFail($id);

        //di default lo slug non cambia a meno che non cambi il titolo del post 
        $modified_post_data['slug'] = $post->slug;

        //se il titolo cambia allora ricalcolo lo slug 
        if($modified_post_data['title'] != $post->title) {
            //creiamo lo slug
            $new_slug = Str::slug($modified_post_data['title'], '-');
            $base_slug = $new_slug;
            //controllo che non esista un post con questo slug.
            $post_with_existing_slug = Post::where('slug', '=', $new_slug)->first();
            $counter = 1;

            //se esiste tento con altri slug
            while($post_with_existing_slug) {
                //provo con un nuovo slug appendendole un counter
                $new_slug = $base_slug . '-' . $counter;
                $counter++;
                //se anche il nuovo slug esiste nel database, il while continua..
                $post_with_existing_slug = Post::where('slug', '=', $new_slug)->first();

            }

            //quando finalmente ho trovato uno slug libero, popoliamo i data da salvare 
            $modified_post_data['slug'] = $new_slug;
        }


        $post->update($modified_post_data);

        return redirect()->route('admin.posts.show', ['post' => $post->id]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {       
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('admin.posts.index');

    }
}
