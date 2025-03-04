@extends('front.layout.app')
@section('content')
<style>
    /* Loader container */
    #loader-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.5); /* Semi-transparent white background */
        z-index: 1000; /* Make sure it appears on top of other elements */
        display: none; /* Initially hidden */
    }
    
    .loader-holder {
        position: absolute;
        top: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

    /* Loader */
    #loader {
        width: 100px; /* Adjust the width */
        height: 100px; /* Adjust the height */
        background-image: url('backend-assets/images/loader.png'); /* Replace with your logo image path */
        background-size: cover; /* Ensure the logo covers the entire area */
        animation: spin 3s infinite linear; /* Add animation (rotation) */
    }

    /* Animation */
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
<div class="page-wrapper">
    <section class="inner-banner">
        <div class="background"><img src="/frontend-assets/assets/img/career-banner.jpg" alt="Background"></div>
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="page-title">Career</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="job-apply-section">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <form method="GET" action="{{ route('career') }}">
                        <div class="filter-row">
                            <div class="form-group">
                                <label class="form-label color-theme">Location</label>
                                <select class="form-control" name="location" onchange="this.form.submit()">
                                    <option value="">Select Location</option>
                                    @foreach ($uniqueLocations as $item)
                                        <option value="{{ $item }}" {{ request('location') == $item ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <div class="form-group">
                                <label class="form-label color-theme">Jobs Category</label>
                                <select class="form-control" name="category" onchange="this.form.submit()">
                                    <option value="">Select Category</option>
                                    @foreach ($uniqueCategories as $item)
                                        <option value="{{ $item }}" {{ request('category') == $item ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                    
                    
                    {{-- <div class="filter-row">
                        <div class="form-group">
                            <label class="form-label color-theme">Location</label>
                            <select class="form-control" id="select_location">
                              <option selected disabled>Select Location</option>
                                @foreach ($uniqueLocations as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label color-theme">Jobs Category</label>
                            <select class="form-control" id="select_category">
                                <option selected disabled>Select Category</option>
                                @foreach ($uniqueCategories as $item)
                                    <option value="{{$item}}">{{$item}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    <div class="row" id="items-container">
                        @foreach ($data as $item)
                        <div class="col-lg-4 col-md-6 col-12 item">
                            <div class="job-card">
                                <h3 class="bg-theme">{{$item->title}}</h3>
                                @php
                                    $createdDate = \Carbon\Carbon::parse($item->created_at);
                                    
                                $today = \Carbon\Carbon::today();
                                $daysDifference = $today->diffInDays($createdDate);
                                $monthsDifference = $today->diffInMonths($createdDate);
                                $yearsDifference = $today->diffInYears($createdDate);
                                @endphp 
                                <div class="content">
                                    <span class="post-time">
                                        <img src="{{asset('/frontend-assets/assets/icons/clock.png')}}" alt="">
                                        @if ($daysDifference == 0) 
                                            posted today.
                                        @elseif($yearsDifference>0)
                                            posted {{$yearsDifference}} years ago.
                                        @elseif($monthsDifference >0)
                                            posted {{$monthsDifference }} months ago.
                                        @else
                                            posted {{$daysDifference}} days ago.
                                        @endif
                                    </span>
                                    <h4 class="color-theme category">{{$item->category}}</h4>
                                    <ul>
                                        <li>Minimum Years of Experience: {{$item->experience}}</li>
                                        <li>Gender: {{$item->gender}}</li>
                                        <li>School Name: {{$item->school}}</li>
                                        <li><span>Location: <span class="location">{{$item->location}}</span></span></li>
                                        <li>Number of Vacancies: {{$item->no_of_vacancy}}</li>
                                    </ul>
                                    {{-- <p>With supporting text below as a natural lead-in to additional content.</p> --}}
                                    <div class="cta-panel">
                                        <a href="{{route('application.form', $item->slug)}}" class="btn btn-theme btn-cta">Apply now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="view-more-cta">
                        <a href="javascript:void(0)" class="btn btn-theme btn-cta" id="view-more-btn">View More</a>
                    </div>  
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>


    $(document).ready(function(){
        // Hide all items beyond the first 6 initially
        $('#items-container .item:gt(5)').hide();

        // Define click event for "View More" button
        $('#view-more-btn').click(function() {
            // Show the next 6 items
            $('#items-container .item:hidden:lt(6)').slideDown();

            // Hide the "View More" button if there are no more hidden items
            if ($('#items-container .item:hidden').length === 0) {
                $('#view-more-btn').hide();
            }
        });
    });

    $(document).ready(function(){
        $('#select_location').change(function(){
            var selectedValue = $(this).val();
            var selectedCategory = $('#select_category').val();
            $('#loader-container').fadeIn();
            $('.item').show(); // Hide the item
            // alert(selectedValue);
            setTimeout(function() {
                $('.item').each(function() {
                    var location = $(this).find('.location').text();
                    var category = $(this).find('.category').text();
                    if (selectedValue !== location) {
                        $(this).hide(); // Hide the item
                    }
                    if (selectedCategory == category) {
                        $(this).show(); // Hide the item
                    }
                });
                $('#loader-container').fadeOut();
            }, 1000); // 1 second delay
        });
    });
    $(document).ready(function(){
        $('#select_category').change(function(){
            var selectedCategory = $(this).val();
            var selectedValue = $('#select_location').val();
            $('#loader-container').fadeIn();
            $('.item').show(); // Hide the item
            // alert(selectedValue);
            setTimeout(function() {
                $('.item').each(function() {
                    var location = $(this).find('.location').text();
                    var category = $(this).find('.category').text();
                    if (selectedCategory !== category) {
                        $(this).hide(); // Hide the item
                    }
                    if (selectedValue == location) {
                        $(this).show(); // Hide the item
                    }
                    
                });
                $('#loader-container').fadeOut();
            }, 1000); // 1 second delay
        });
    });
</script>

@endsection