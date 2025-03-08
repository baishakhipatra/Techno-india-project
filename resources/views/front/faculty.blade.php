@extends('front.layout.app')
@section('content')

<section class="innerbanner" style="background-image: url('master/images/innerbanner1.jpg')">
    <div class="container">
        <div class="inner_bannercont">
            <h1 class="mb-0 text-uppercase">Faculty</h1>
        </div>
    </div>
</section>

<section class="faculty">
    <div class="container">
        @if(count($class_name))
            @foreach ($class_name as $item)
                <div class="row border-0 mt-1 justify-content-center">
                    <div class="col-md-12 text-center">
                        <h1 class="text_blue">{{$item->class_name}}</h1>
                        <span class="line_border"></span>
                    </div>
                    {{-- {{dd($data)}} --}}
                    @foreach ($data as $ditem)
                        @if($ditem->class_name==$item->class_name)
                            <div class="card col-lg-3 col-md-6 border-0 mt-5">
                                <div class="card-body p-0 faculty_cont">
                                    <div class="img_box">
                                    <img src="{{asset($ditem->image)}}" class="img-fluid" alt="...">
                                </div>
                                <h5 class="mt-3 mb-1">{{$ditem->name}}</h5>
                                <span>{{$ditem->designation}}</span>
                                <p class="card-text mt-2">{{Str::limit($ditem->desc, 200)}}</p>
                                </div>
                                <div class="card-footer mt-3 border-0 p-0">
                                <ul class="mb-0 pl-0">
                                    @if($ditem->facebook_link)
                                    <li><a href="{{$ditem->facebook_link}}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    @endif
                                    @if($ditem->twitter_link)
                                    <li><a href="{{$ditem->twitter_link}}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    @endif
                                    @if($ditem->instagram_link)
                                    <li><a href="{{$ditem->instagram_link}}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                    @endif
                                </ul>
                                </div>
                            </div>
                        @endif
                    @endforeach
                  
                </div>
            @endforeach
        @endif
    </div>
</section>

<section class="project" style="background-image: url('./master/images/projectbg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-6 py-lg-0 py-md-0 py-2">
                <div class="form_btn">
                    <a href="" class="w-100">Admisions Open</a>
                </div>
            </div>
            <div class="col-md-6 py-lg-0 py-md-0 py-2">
                <div class="form_btn">
                    <a href="" class="w-100">Academics and Contact Us</a>
                </div>
            </div>
          
        </div>
    </div>
</section>

@endsection