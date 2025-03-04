@extends('layouts.App');
@section('content')
<div class="container">
    <h2 class="mb-4">Edit Unit List</h2>
    <form action="{{route('unit.store',$unit->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{$unit->title}}">
            @error('title') <p class="small text-danger">{{ $message }}</p> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection