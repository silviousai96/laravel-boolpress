@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="btn btn-success">Modifica post</a>
        </div>
        
        <h1>{{$post->title}}</h1>

        <div class="mt-2 mb-2"> <strong>Slug:</strong> {{$post->slug}} </div>
        
        @if($post->category)
            <div class="mt-2 mb-2"> <strong>Categoria:</strong> {{ $post->category->name }}</div>
        @endif

        <div class="mt-2 mb-2">
            <strong>Tags:</strong>
            @foreach ($post_tags as $tag)
                {{$tag->name}}{{$loop->last ? '' : ', '}}
            @endforeach
    
        </div>

        <p>{{$post->content}}</p>

    </div>


@endsection