@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Gestisci post</h1>

        <div class="row">
            @foreach ($posts as $post)
                <div class="col-6">
                    
                    <div class="card" >
                        
                        <div class="card-body">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="btn btn-primary">Vai al post</a>
                            
                            <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="btn btn-success">Modifica post</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


@endsection