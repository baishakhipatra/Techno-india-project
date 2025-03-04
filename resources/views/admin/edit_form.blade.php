@extends('layouts.app')
@section('content')

<div class="container">
    <h2>Edit Profile</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="container">
    <form action="{{route('update.form', $admission->id)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" value="{{old('name', $admission->name)}}" required>
        </div>

        <div class="form-group">
            <label for="dob">DOB:</label>
            <input type="date" name="dob" class="form-control" value="{{old('dob', $admission->dob)}}" required>
        </div>
        
        <div class="form-group">
            <label for="class">Class:</label>
            <input type="class" name="class" class="form-control" value="{{old('class', $admission->class)}}" required>
        </div>

        <div class="form-group">
            <label for="parent_name">Parent Name:</label>
            <input type="text" name="parent_name" class="form-control" value="{{old('parent_name', $admission->class)}}" required>
        </div>

        <div class="form-group">
            <label for="country_code">Country Code:</label>
            <input type="number" name="country_code" class="form-control" value="{{old('country_code', $admission->country_code)}}" required>
        </div>

        <div class="form-group">
            <label for="mobile">Mobile:</label>
            <input type="number" name="mobile" class="form-control" value="{{old('mobile', $admission->mobile)}}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{old('email', $admission->email)}}" required>
        </div>

        <div class="form-group">
            <label for="pincode">Pin Code:</label>
            <input type="number" name="pincode" class="form-control" value="{{old('pincode', $admission->pincode)}}" required>
        </div>

        <button type="submit" class="btn btn-danger btn-sm">Update</button>
    </form>
    </div>
</div>
@endsection