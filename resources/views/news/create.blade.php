@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Create News Article</h1>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
    
        <form method="post" action="{{ route('news.store') }}">
            @csrf
            <label for="title">Title:</label>
            <input type="text" name="title" required>
            <br>
            <label for="content">Content:</label>
            <textarea name="content" required></textarea>
            <br>
            <button type="submit">Create Article</button>
        </form>

</div>
@endsection