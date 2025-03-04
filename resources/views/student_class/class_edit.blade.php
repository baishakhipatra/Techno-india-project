@extends('layouts.App');
@section('content')
<div class="container">
    <h2 class="mb-4">Edit class List</h2>
    <form action="{{route('class.store.edit',$data->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}">
            @error('name') <p class="small text-danger">{{ $message }}</p> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection