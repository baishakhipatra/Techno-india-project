@extends('layouts.app')
@section('content')


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('settings.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="official_phone1"> Official Contact Number 1<span class="text-danger">*</label>
                                <input type="text" class="form-control" name="official_phone1" id="official_phone1" value="{{old('official_phone1') ? old('official_phone1') : $data[0]->content }}">
                                @error('official_phone1') <p class="small text-danger">{{$message}}</p>@enderror
                            </div>
                            <div class="form-group">
                                <label for="official_phone2">Official contact number 2</label>
                                <input type="text" class="form-control" name="official_phone2" id="official_phone2" value="{{ old('official_phone2') ? old('official_phone2') : $data[1]->content }}">
                                @error('official_phone2') <p class="small text-danger">{{ $message }}</p> @enderror
                            </div>
                            <div class="form-group">
                                <label for="official_email"> Official Email<span class="text-danger">*</label>
                                <input type="text" class="form-control" name="official_email" id="official_email" value="{{old('official_email')? old('official_email') : $data[2]->content }}">
                                @error('official_email') <p class="small text-danger">{{$message}}</p>@enderror
                            </div>
                            <div class="form-group">
                                <label for="website_link"> Website<span class="text-danger">*</label>
                                <input type="text" class="form-control" name="website_link" id="website_link" value="{{old('website_link')? old('website_link') : $data[3]->content }}">
                                @error('website_link') <p class="small text-danger">{{$message}}</p>@enderror
                            </div>
                            <div class="form-group">
                                <label for="full_company_name">Full Company Name<span class="text-danger">*</label>
                                <input type="text" class="form-control" name="full_company_name" id="full_company_name" value="{{old('full_company_name')? old('full_company_name') : $data[4]->content }}">
                                @error('full_company_name') <p class="small text-danger">{{$message}}</p>@enderror
                            </div>
                            <div class="form-group">
                                <label for="pretty_company_name">Pretty Company Name<span class="text-danger">*</label>
                                <input type="text" class="form-control" name="pretty_company_name" id="pretty_company_name" value="{{old('pretty_company_name')? old('pretty_company_name') : $data[5]->content }}">
                                @error('pretty_company_name') <p class="small text-danger">{{$message}}</p>@enderror
                            </div>
                            <div class="form-group">
                                <label for="company_short_desc">Short Company description <span class="text-danger">*</label>
                                <input type="text" class="form-control" name="company_short_desc" id="company_short_desc" value="{{old('company_short_desc')? old('company_short_desc') : $data[6]->content }}">
                                @error('company_short_desc') <p class="small text-danger">{{$message}}</p>@enderror
                            </div>
                            <div class="form-group">
                                <label for="company_full_address"> Full Company Address<span class="text-danger">*</label>
                                <input type="text" class="form-control" name="company_full_address" id="company_full_address" value="{{old('company_full_address')? old('company_full_address') : $data[7]->content }}">
                                @error('company_full_address') <p class="small text-danger">{{$message}}</p>@enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection