@extends('front.layout.app')
@section('content')

<section class="innerbanner" style="background-image: url('master/images/innerbanner1.jpg')">
    <div class="container">
        <div class="inner_bannercont">
            <h1 class="mb-0 text-uppercase">Extra Curricular</h1>
        </div>
    </div>
</section>


        <section class="extra_curricular">
            <div class="container-fluid p-lg-0 p-md-0">
                @foreach($ExtraCurricular as $key=>$item)
                @if($key % 2 == 0)
                    <div class="row extra_curricular_cont1 py-lg-5 py-md-5">
                        <div class="col-md-6 order-lg-1 order-md-1 order-2">
                            <div class="extra_curricular_cont1_cont pr-lg-5 mt-lg-0 mt-md-0 mt-3">
                                <h2 class="mb-lg-4 mb-2">{{$item->title}}</h2>
                                <p class="mb-0">{{$item->description}}</p>
                            </div>
                        </div>
                        <div class="col-md-6 order-lg-2 order-md-2 order-1">
                            <img src="{{$item->image}}" class="img-fluid w-60" alt="" width="100%">
                        </div>
                    </div>
                @else
                    <div class="row extra_curricular_cont2 py-lg-5 py-md-5">
                        <div class="col-md-6 order-lg-1 order-md-1 order-1">
                            <img src="{{$item->image}}" class="img-fluid w-60" alt="">
                        </div>
                        <div class="col-md-6 order-lg-2 order-md-2 order-2">
                            <div class="extra_curricular_cont2_cont pl-lg-5 mt-lg-0 mt-md-0 mt-3">
                                <h2 class="mb-lg-4 mb-2">{{$item->title}}</h2>
                                <p class="mb-0">{{$item->description}}</p>
                            </div>
                        </div>
                    </div>
                @endif
                @endforeach
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