@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Titolo test</h1>

        <h2>sottotitolo test</h2>

        <div class="row">
            @foreach ($posts as $post)
                <div class="col-6">
                    
                    <div class="card" >
                        
                        <div class="card-body">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <a href="{{ route('blog-page', ['slug' => $post->slug]) }}" class="btn btn-primary">Vai al post</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


@endsection