@extends('front.layout.app')
@section('content')

<section class="innerbanner" style="background-image: url('master/images/innerbanner1.jpg')">
    <div class="container">
        <div class="inner_bannercont">
            <h1 class="mb-0 text-uppercase"></h1>
        </div>
    </div>
</section>

<section class="choose_us">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7 text-center">
                <h1 class="text_blue">Why Choose Us</h1>
                <span class="line_border"></span>
            </div>
        </div>
        <div class="row mt-4">
            @foreach ($WhyChooseUs as $item)
                <div class="col-lg-3 col-md-6 mt-4">
                    <div class="choose_us_cont">
                        <span>
                            <img src="{{asset($item->image)}}" class="img-fluid" alt="">
                        </span>
                        <h5 class="">{{$item->title}}</h5>
                        {{Str::limit(strip_tags($item->description), 200, '.....')}}
                        {{-- <p class="">{{$item->desc}}</p> --}}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="gallery">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h1 class="text_blue text-uppercase">Gallery</h1>
                <span class="line_border"></span>
                <div class="owl-carousel owl-theme gallery_slide mt-lg-5 mt-4">
                    @foreach ($gallery  as $item)
                    @if($item->image)
                        <div class="item">
                            <a href="{{asset($item->image)}}" class="fresco" data-fresco-caption="Title 1" data-fresco-group="shared_options" data-fresco-group-options="ui: 'inside',overlay: { close: false }"><img src="{{asset($item->image)}}" class="img-fluid w-100"></a>
                        </div>
                    @else
                        <div class="item">
                            <div class="video">
                                <a href="{{ asset($item->video) }}" class="fresco" data-fresco-caption="Title 1" data-fresco-group="shared_options" data-fresco-group-options="ui: 'inside',overlay: { close: false }">
                                    
                                    <img src="{{asset('master/images/gallerybg1.jpg')}}" class="img-fluid w-100">
                                </a>
                                <span class="blob">
                                    <a href="{{ asset($item->video) }}" class="fresco">
                                        <img src="{{asset('master/images/video_icon.png')}}" class="img-fluid video_icon">
                                    </a>
                                </span>
                            </div>
                        </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
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