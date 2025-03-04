@extends('layouts.app')
@section('content')

<div class="container">
   <h2 class="mb-4">Edit curricular list</h2>
    <form action="{{route('curricular.store.edit',$data->id)}}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $data->title }}" required>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <div>
                <img src="{{ asset($data->image) }}" alt="Current image" width="100">
            </div>
            <input type="file" class="form-control" id="image" name="image" value="{{ $data->image }}">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="4" required>{{ $data->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>   
</div>
@endsection