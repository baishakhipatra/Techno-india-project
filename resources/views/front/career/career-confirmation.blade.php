@extends('front.layout.app');
@section('content')

<div class="page-wrapper">
    <div class="page-wrapper">
        <section class="inner-banner">
            <div class="background"><img src="assets/img/career-banner.jpg" alt="background"></div>
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="offset-xxl-1 col-xxl-10 col-12">
                            <h2 class="page-title">Application Form</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="form-section">
            <div class="container">
                <div class="row">
                    <div class="offset-xxl-1 col-xxl-10 col-12">
                        <div class="form-box">
                            <h3>Confirmation</h3>

                            <div class="confirmation-box">
                                <p> you have successfully completed the registration</br>
                                <span> Application id: <span id="application_id">{{session('registration_id')}}</span></span>
                                </p>
                                <div class="cta">
                                    <a href="{{'front.career.index'}}" class="btn btn-theme btn-cta">Back to career portal</a>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
            </div>
        </section>
    </div>
</div> 

@endsection

<script>
    // var application_id = localStorage.getItem('application_id');

    // if(application_id){
    //     $('#application_id').text(application_id);
    // }
    // if(!sessionStorage.getItem('pageReloaded'))
    // {
    //     localStorage.clear();
    //     sessionStorage.setItem('pageReloaded','true');
    // }

    document.addEventListener("DOMContentLoaded", function () {
    var application_id = localStorage.getItem('application_id');
    
    if (application_id) {
        document.getElementById('application_id').textContent = application_id;
    }

    setTimeout(function() {
        localStorage.clear();
    }, 5000); 
});


</script>
