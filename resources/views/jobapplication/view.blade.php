@extends('layouts.app')
@section('content')
<style>
    .user-images {
        display: flex;
        flex-wrap: wrap;
        list-style-type: none;
        padding: 20px 0;
        margin: 0 -4px;
    }
    .user-images li {
        display: flex;
        align-items: center;
        justify-content: center;
        width: calc((100% - 40px) / 5);
        height: 140px;
        overflow: hidden;
        border-radius: 6px;
        margin: 0 4px 8px;
    }
    .user-images li img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    @media only screen and (max-width: 1599px) {
        .user-images li {
            height: 120px;
        }
    }
    @media only screen and (max-width: 1399px) {
        .user-images li {
            height: 100px;
        }
    }
    @media only screen and (max-width: 1299px) {
        .user-images li {
            height: 80px;
        }
    }
    @media only screen and (max-width: 1199px) {
        .user-images li {
            height: 100px;
        }
    }
    @media only screen and (max-width: 991px) {
        .user-images li {
            height: 140px;
        }
    }
    @media only screen and (max-width: 799px) {
        .user-images li {
            height: 120px;
        }
    }
    @media only screen and (max-width: 699px) {
        .user-images li {
            height: 100px;
        }
    }
    @media only screen and (max-width: 575px) {
        .user-images li {
            height: 80px;
        }
    }
    @media only screen and (max-width: 499px) {
        .user-images li {
            width: calc((100% - 32px) / 4);
        }
    }
    @media only screen and (max-width: 399px) {
        .user-images li {
            width: calc((100% - 24px) / 3);
        }
    }
    @media only screen and (max-width: 359px) {
        .user-images li {
            height: 70px;
        }
    }
    #form_data li{
        display: inline-table;
        text-align: center;
    }
    #form_data li img{
        max-height: 150px;
    }
</style>


<section class="content" id="form-data">
    <div class="contaier-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row mb-3">
                            <div class="col-md-12 text-right">
                                <a href="{{route("application.list")}}" class="btn btn-primary btn-sm"><i class="fa fa-chevron left"></i>Back</a>
                        
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                    <label>Registration ID:</label>
                                    <p>{{$data->registration_id}}</p>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                    <label>Job Title:</label>
                                    <p>{{$data->Jobs?$data->Jobs->title:""}}</p>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                    <label>Name:</label>
                                    <p>{{$data->name}}</p>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                    <label>Fathers's Name:</label>
                                    <p>{{$data->father_name}}</p>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                    <label>Email:</label>
                                    <p>{{$data->email}}</p>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                    <label>Mobile:</label>
                                    <p>{{$data->phone}}</p>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                    <label>Date of birth:</label>
                                    <p>{{$data->date_of_birth}}</p>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                    <label>Gender:</label>
                                    <p>{{$data->gender}}</p>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                    <label>Marital Status:</label>
                                    <p>{{$data->merital_status}}</p>
                                </div>
                                <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                    <label>Address:</label>
                                    <p>{{$data->address}}{{$data->landmark?','.$data->landmark:""}},{{$data->city}},{{$data->dist}},{{$data->state}}{{$data->pincode}}</p>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <strong>Educational Qualification</strong>
                                </div>
                                <div class="card-body">
                                    <p class="text-danger text-sm mt-4">10th grade qualification(Standard X)</p>
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>Institute/school name:</label>
                                            <p>{{$data->x_school_name}}</p>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>Afflified education Board:</label>
                                            <p>{{$data->x_board_name}}</p>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>percentage Accuired:</label>
                                            <p>{{$data->x_percentage}}</p>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>Passing year:</label>
                                            <p>{{$data->x_passing_year}}</p>
                                        </div>
                                    </div>
                                    <p class="text-danger text-sm mt-4">12th grade qualification(Standard Xii)</p>
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>Institute/school name:</label>
                                            <p>{{$data->xii_school_name}}</p>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>Afflified education Board:</label>
                                            <p>{{$data->xii_board_name}}</p>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>percentage Accuired:</label>
                                            <p>{{$data->xii_percentage}}</p>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>Passing year:</label>
                                            <p>{{$data->xii_passing_year}}</p>
                                        </div>
                                    </div>

                                    @php
                                        $count =1;
                                    @endphp
                                    @foreach($higherStudies as $item)
                                    <p class="badge badge-pill badge-danger">{{$count++}}</p>
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>Qualification:</label>
                                            <p>{{$item->after_xii_qualification}}</p>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>Institute Name:</label>
                                            <p>{{$item->after_xii_institute_name}}</p>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>Afflified board/university:</label>
                                            <p>{{$item->after_xii_institute_board}}</p>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>Area of specilization:</label>
                                            <p>{{$item->after_xii_institute_stream}}</p>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>Percentage required:</label>
                                            <p>{{$item->after_xii_institute_percentage}}</p>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>Passing year:</label>
                                            <p>{{$item->after_xii_institute_passing_year}}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <strong>work experience</strong>
                                </div>
                                <div class="card-body">
                                    @foreach($experience as $exp)
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>Year of Experience:</label>
                                            <p>{{$exp->experience_type}}</p>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>Type of experience:</label>
                                            <p>{{$exp->experience_duration}}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>Present salary(P.A):</label>
                                            <p>{{$data->present_salary}}</p>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>Expected salary(P.A):</label>
                                            <p>{{$data->expected_salary}}</p>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>If selcted, Time required to join:</label>
                                            <p>{{$data->join_time}}</p>
                                        </div>

                                        @if($data->know_anyone_at_tigs=="Yes")
                                        <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                            <label>Name of referrence at atechno india group:</label>
                                            <p>{{$data->referrence_details}}</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                    <ul class="user images">
                                        <li style= "width: 30%;"><a href="{{asset($data->resume_file)}}" class="btn btn-primary" download>Download resume</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-3 col-lg-4 col-sm-6 col-12"> 
                                <ul class="user-images">
                                    <li>
                                        <img src="{{ asset($data->aadhar_card_file) }}" alt="banner-image"> <br>
                                        <label for="">Aadhaar Card</label>
                                    </li>
                                    <li>
                                        <img src="{{ asset($data->pan_card_file) }}" alt="banner-image"> <br>
                                        <label for="">Pan Card</label>
                                    </li>
                                    <li>
                                        <img src="{{ asset($data->signature) }}" alt="banner-image"> <br>
                                        <label for="">Signature</label>
                                    </li>
                                    <li>
                                        <img src="{{ asset($data->x_admit_card) }}" alt="banner-image"> <br>
                                        <label for="">Admit card</label>
                                    </li>
                                    <li>
                                        <img src="{{ asset($data->image_file) }}" alt="banner-image"> <br>
                                        <label for="">Photo</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection