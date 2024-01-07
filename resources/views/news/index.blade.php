@extends('layouts.app')

@section('content')
    <div class="container">

    
    <div class="row homepage-spacer">
        <p><a href="{{ route('homepage.index') }}">Home</a> / <a href="{{ route('news.index') }}">News</a></p>
        <h1>News Articles</h1>
        @foreach ($news as $article)
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">{{ $article->title }}</div>
                <div class="card-body"><p>{{ $article->content }}</p>
            <p class="date"><br>Published on {{ \Carbon\Carbon::parse($article->created_at)->format('F j, Y') }}</p></div>
            </div>
        </div>
        @endforeach
    </div>  
 

            <p><strong></strong></p>
            
            </li>



</div>
@endsection