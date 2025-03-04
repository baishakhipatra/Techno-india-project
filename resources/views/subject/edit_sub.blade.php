@extends('layouts.App');
@section('content')
<div class="container">
    <h2 class="mb-4">Edit subject List</h2>
    <form action="{{ route('sub.store', $sub->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $sub->title }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    
</div>
@endsection