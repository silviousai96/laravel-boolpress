@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Crea nuovo post</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        {{-- create form --}}
        <form action="{{route('admin.posts.store')}}" method="post">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="title">Titolo</label>
                <input type="text" class="form-control" id="title" name="title" value="{{old('title', 'default')}}">
            </div>

            <div class="form-group">
                <label for="content">Contenuto</label>
                <textarea class="form-control" name="content" id="content" cols="30" rows="10" {{old('content')}}></textarea>
            </div>

            <input type="submit" class="btn btn-success" value="Salva post">
        </form>

        {{-- end create form --}}
    </div>


@endsection