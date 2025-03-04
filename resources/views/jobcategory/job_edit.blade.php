@extends('layouts.App');
@section('content')
<div class="container">
    <h2 class="mb-4">Edit job category List</h2>
    <form action="{{ route('job.store.edit', $job->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $job->title }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    
</div>
@endsection