@extends('layouts.app')

@section('content')
    <div class="container">

    <h1>News Articles</h1>

    <ul>
        @foreach ($news as $article)
            <li>
                <strong>{{ $article->title }}</strong>
                <p>{{ $article->content }}</p>
            </li>
        @endforeach
    </ul>

</div>
@endsection