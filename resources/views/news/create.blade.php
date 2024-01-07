@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>Create News Article</h1>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif
    
        <form method="post" action="{{ route('news.store') }}">
            @csrf
            <label class="viking-label" for="title">Title:</label>
            <input class="viking-input" type="text" name="title" id="title" required>
            <br>
            <label class="viking-label" for="content">Content:</label>
            <textarea class="viking-input" name="content" id="content" required></textarea>
            <br>
            <label class="viking-label" for="category">Category:</label>
            <select class="viking-select" id="category" name="category">
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <option value="option3">Option 3</option>
            </select>
            <br>
            <button class="viking-button"type="submit">Create Article</button>
        </form>

</div>
@endsection