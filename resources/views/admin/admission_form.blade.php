@extends('layouts.app')
@section('content')

<div class="container">
    <h1>Admission form</h1>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="{{route('form.submit')}}" method="POST">
    @csrf
    <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
        @error('name')
            <div class="text-danger">{{$message}}></div>
        @enderror
    </div>

    <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="date" class="form-control" name="dob" id="dob" value="{{old('dob')}}">
        @error('dob')
            <div class="text-danger">{{$message}}></div>
        @enderror
    </div>

    <div class="form-group">
        <label for="class">Class</label>
        <input type="class" class="form-control" name="class" id="class" value="{{old('class')}}">
        @error('class')
            <div class="text-danger">{{$message}}></div>
        @enderror
    </div>

    <div class="form-group">
        <label for="parent_name">Parent Name</label>
        <input type="text" class="form-control" name="parent_name" id="parent_name" value="{{old('parent_name')}}">
        @error('parent_name')
            <div class="text-danger">{{$message}}></div>
        @enderror
    </div>

    
    <div class="form-group">
        <label for="country_code">Country Code</label>
        <input type="number" class="form-control" name="country_code" id="country_code" value="{{old('country_code')}}">
        @error('country_code')
            <div class="text-danger">{{$message}}></div>
        @enderror
    </div>

    
    <div class="form-group">
        <label for="mobile">Mobile</label>
        <input type="number" class="form-control" name="mobile" id="mobile" value="{{old('mobile')}}">
        @error('mobile')
            <div class="text-danger">{{$message}}></div>
        @enderror
    </div>

    
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
        @error('email')
            <div class="text-danger">{{$message}}></div>
        @enderror
    </div>

    
    <div class="form-group">
        <label for="pincode">Pin code</label>
        <input type="number" class="form-control" name="pincode" id="pincode" value="{{old('pincode')}}">
        @error('pincode')
            <div class="text-danger">{{$message}}></div>
        @enderror
    </div>

    <div class="form-group">
        <label for="utm_source">UTM Source</label>
        <input type="utm_source" class="form-control" name="utm_source" id="utm_source" value="{{old('utm_source')}}">
        @error('utm_source')
            <div class="text-danger">{{$message}}></div>
        @enderror
    </div>

    <div class="form-group">
        <label for="utm_medium">UTM Medium</label>
        <input type="utm_medium" class="form-control" name="utm_medium" id="utm_medium" value="{{old('utm_medium')}}">
        @error('utm_medium')
            <div class="text-danger">{{$message}}></div>
        @enderror
    </div>

    <div class="form-group">
        <label for="utm_content">UTM Content</label>
        <input type="utm_content" class="form-control" name="utm_content" id="utm_content" value="{{old('utm_content')}}">
        @error('utm_content')
            <div class="text-danger">{{$message}}></div>
        @enderror
    </div>

    <div class="form-group">
        <label for="utm_campaign">UTM Campaign</label>
        <input type="utm_campaign" class="form-control" name="utm_campaign" id="utm_campaign" value="{{old('utm_campaign')}}">
        @error('utm_campaign')
            <div class="text-danger">{{$message}}></div>
        @enderror
    </div>

    <div class="form-group">
        <label for="utm_term">UTM term</label>
        <input type="utm_term" class="form-control" name="utm_term" id="utm_term" value="{{old('utm_term')}}">
        @error('utm_term')
            <div class="text-danger">{{$message}}></div>
        @enderror
    </div>

    <button type="submit" class="btn btn-info btn-sm">Submit</button>
</form>
</div>

@endsection