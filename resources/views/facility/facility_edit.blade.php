@extends('layouts.app')
@section('content')

<div class="container">
   <h2 class="mb-4">Edit facility list</h2>
    <form action="{{route('facility.store.edit',$data->id)}}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $data->title }}" required>
        </div>
        <div class="form-group">
            <label for="logo">Logo:</label>
            <div>
                {{-- <td><img src="{{asset($item->logo)}}" alt="No Logo" srcset="" height="60px" width="60px" class="img-thumbnail" title="{{ $item->title }}'s Logo"></td> --}}
                <img src="{{asset($data->logo)}}" alt="Current Logo" width="100">
            </div>
            <input type="file" class="form-control" id="logo" name="logo" value="{{ $data->logo}}">
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