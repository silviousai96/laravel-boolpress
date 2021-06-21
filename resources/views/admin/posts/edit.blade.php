@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifica post</h1>

        <h2>Nome post: {{$post->title}}</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        {{-- edit form --}}
        <form action="{{ route('admin.posts.update', ['post' => $post->id]) }}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{old('title', $post->title)}}">
            </div>

            <div class="form-group">
                <label for="content">Contenuto</label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10" >{{old('content', $post->content)}}</textarea>
            </div>

            <input type="submit" class="btn btn-success" value="Salva post">
        </form>

        {{-- end edit form --}}
    </div>
@endsection