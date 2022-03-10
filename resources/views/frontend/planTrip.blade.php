@extends('layouts.app')
@push('meta')
@include('frontend.partials._meta-tags', [
'mtitle' => 'Plan Trip Upscale Adventures',
'title' => 'Plan Your Trip',
'description' => 'Plan your next adventure with Upscale Adventures. We are here to help you plan your next adventure with us.',
'og' => '',
'twitter' => '',
'robot' => ''

])
<script type="application/ld+json">
    {"@context":"http://schema.org/","@type":"Organization","name":"Upscale Adventures","address":{"@type":"PostalAddress","streetAddress":"Keshar Mahal Marg, Thamel","addressLocality":"Kathmandu","addressRegion":"Bagmati","postalCode":"44600"},"telephone":"+977-9851062726"}
</script>
@endpush
@section('content')
@inject('countries','App\Http\Utilities\Country')
<div class="navbar-gap"></div>

<div class="heading-wrapper-main">
    <div>
        <div class="container">
            <h1 class="heading-main">Plan Your Trip</h1>
        </div>
    </div>
</div>
<div>
    <section class="section-content">
        <div class="container">
            <div class="row">
                <div class="loading">
                    <div class="loader"></div>
                </div>
                <div class="col-12">                    
                    <form method="POST" id="signup-form" class="signup-form" >
                        @csrf
                        <div class="col-md-6 offset-md-3" id="errorWrapper" style="display: none">
                            <div class="alert alert-danger errorContainer" role="alert"></div>
                        </div>

                        <h3>
                            <span class="title_text">Group Size</span>
                        </h3>
                        <fieldset>
                            <div class="fieldset-content">
                                <div class="row mt-3 mb-5">
                                    <div class="col-12 mt-3 mb-5 text-center">
                                        <h4>When Do You Plan To Travel?</h4>
                                    </div>
                                    <div class=" col-6 col-md-3">
                                        <div class="travelType text-center">
                                            <input type="radio" name="travelType" id="travelTypeSolo" value="1" class="noShow">
                                            <label for="travelTypeSolo">
                                                <div class="travelTypeImage">
                                                    <i class="fas fa-user single fa-5x"></i>
                                                </div>
                                                <h4 class="travelTypeText my-4">Solo</h4>
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-6 col-md-3">
                                        <div class="travelType text-center">
                                            <input type="radio" name="travelType" id="travelTypeCouple" value="2" class="noShow">
                                            <label for="travelTypeCouple">
                                                <div class="travelTypeImage">
                                                    <i class="fas fa-user single fa-5x"></i>
                                                </div>
                                                <h4 class="travelTypeText my-4">Couple/2 Person</h4>
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-6 col-md-3">
                                        <div class="travelType text-center">
                                            <input type="radio" name="travelType" id="travelTypeFamily" value="3" class="noShow">
                                            <label for="travelTypeFamily">
                                                <div class="travelTypeImage">
                                                    <i class="fas fa-user single fa-5x"></i>
                                                </div>
                                                <h4 class="travelTypeText my-4">Family</h4>
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-6 col-md-3">
                                        <div class="travelType text-center">
                                            <input type="radio" name="travelType" id="travelTypeGroup" value="4" class="noShow">
                                            <label for="travelTypeGroup">
                                                <div class="travelTypeImage">
                                                    <i class="fas fa-user single fa-5x"></i>
                                                </div>
                                                <h4 class="travelTypeText">Group</h4>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-5" id="forGroup" style="display: none">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="adult">No. of Adult</label>
                                                <input type="number" class="form-control mb-2 mr-sm-2" id="adult" name="adult">
                                            </div>
                                            <div class="col-6">
                                                <label for="children">No of children</label>
                                                <input type="number" class="form-control mb-2 mr-sm-2" id="children" name="children">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="fieldset-footer">
                                    <span>Step 1 of 3</span>
                                </div>
                        </fieldset>

                        <h3>
                            <span class="title_text">Travel Date</span>
                        </h3>
                        <fieldset>

                            <div class="fieldset-content">
                                <div class="row mt-3 mb-5">
                                    <div class="col-12 mt-3 mb-5 text-center">
                                        <h4>When Do You Plan To Travel?</h4>
                                    </div>

                                    <div class=" col-12 col-md-4">
                                        <div class="travelDate text-center">
                                            <input type="radio" name="travelDate" id="travelDatehave" value="1" class="noShow" >
                                            <label for="travelDatehave">
                                                <div class="travelDateImage">
                                                    <i class="far fa-calendar-check fa-5x"></i>
                                                </div>
                                                <h4 class="travelDateText my-4">I have my date</h4>
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-12 col-md-4">
                                        <div class="travelDate text-center">
                                            <input type="radio" name="travelDate" id="travelDateapprox"
                                                value="2" class="noShow">
                                            <label for="travelDateapprox">
                                                <div class="travelDateImage">
                                                    <i class="far fa-calendar-alt fa-5x"></i>
                                                </div>
                                                <h4 class="travelDateText my-4">I have approx. date</h4>
                                            </label>
                                        </div>
                                    </div>
                                    <div class=" col-12 col-md-4">
                                        <div class="travelDate text-center">
                                            <input type="radio" name="travelDate" id="travelDateplanning"
                                                value="3"class="noShow" >
                                            <label for="travelDateplanning">
                                                <div class="travelDateImage">
                                                    <i class="far fa-calendar-times fa-5x"></i>
                                                </div>
                                                <h4 class="travelDateText my-4">No still planning</h4>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-5" id="forDate" style="display: none">
                                    <div class="col-md-6 offset-md-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <label for="start">Start</label>
                                                <input type="text" class="form-control mb-2 mr-sm-2" id="start" name="startDate">
                                            </div>
                                            <div class="col-6">
                                                <label for="end">End</label>
                                                <input type="text" class="form-control mb-2 mr-sm-2" id="end" name="endDate">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="fieldset-footer">
                                <span>Step 2 of 3</span>
                            </div>

                        </fieldset>

                        <h3>
                            <span class="title_text">Travel Info</span>
                        </h3>
                        <fieldset>

                            <div class="fieldset-content">
                                <div class="row mt-3 mb-5">
                                    <div class="col-12 mt-3 mb-5 text-center">
                                        <h4>Where Do You Plan To Travel?</h4>
                                    </div>
                                    <div class="col text-center">
                                        <div class="form-row">
                                            <div class="col-6 needHelp">
                                                <input class="form-check-input" type="radio" id="haveTrip" value="1"
                                                    name="haveTrip" checked>
                                                <label class="form-check-label" for="haveTrip">I have my preferred
                                                    trip</label>
                                            </div>
                                            <div class="col-6 needHelp">
                                                <input class="form-check-input" type="radio" id="needHelp" value="0"
                                                    name="haveTrip" >
                                                <label class="form-check-label" for="needHelp">No, I need your expert
                                                    help</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 mb-5">
                                    <div class="col-md-6 offset-md-3" id="forTripInput" style="display: none">
                                        <div class="form-group">
                                            <label for="tripNameInput">Where you want to visit?</label>
                                            <input type="text" class="form-control" id="tripNameInput"
                                                name="tripNameInput">
                                        </div>
                                    </div>
                                    <div class="col-md-6 offset-md-3" id="forTripSelect">
                                        <div class="form-group">
                                            <label for="tripNameSelect">Where you want to visit?</label>
                                            <select class="form-control" id="tripNameSelect" name="tripNameSelect">
                                                <option value="">Select trip</option>
                                                @foreach ($tours as $tour)
                                                <option value="{{$tour->id}}">{{$tour->days.' Day(s)'.$tour->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 offset-md-3">
                                        <div class="form-group">
                                            <label for="destinationDescription">
                                                Describe below (Optional)</label>
                                            <textarea class="form-control" id="destinationDescription"
                                                rows="3" name="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fieldset-footer">
                                <span>Step 3 of 4</span>
                            </div>

                        </fieldset>

                        <h3>
                            <span class="title_text">Submit</span>
                        </h3>
                        <fieldset>

                            <div class="fieldset-content">
                                <div class="row mt-3 mb-5">
                                    <div class="col-12 mt-3 mb-5 text-center">
                                        <h4>Contact details</h4>
                                    </div>
                                    <div class="col-md-6 offset-md-3">
                                        <div class="form-group">
                                            <label class="form-check-label" for="name">Name</label>
                                            <input class="form-control" type="text" id="name" placeholder="Full Name"
                                                name="name">

                                        </div>
                                        <div class="form-group">
                                            <label class="form-check-label" for="email">Email</label>
                                            <input class="form-control" type="email" id="email" placeholder="Email"
                                                name="email">

                                        </div>
                                        <div class="form-group">
                                            <label class="form-check-label" for="tel">Contact Number</label>
                                            <input class="form-control" type="tel" id="tel" placeholder="Telephone"
                                                name="telephone">

                                        </div>
                                        <div class="form-group">
                                            <label for="form-country">
                                                Country
                                            </label>
                                            <select name="country" id="form-country" class="form-control rounded-0">
                                                @foreach($countries::all() as $code => $name)
                                                <option value="{{$name}}">{{$name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fieldset-footer">
                                <span>Step 4 of 4</span>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
    integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"
    integrity="sha512-XZEy8UQ9rngkxQVugAdOuBRDmJ5N4vCuNXCh8KlniZgDKTvf7zl75QBtaVG1lEhMFe2a2DuA22nZYY+qsI2/xA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"
    integrity="sha512-bE0ncA3DKWmKaF3w5hQjCq7ErHFiPdH2IGjXRyXXZSOokbimtUuufhgeDPeQPs51AI4XsqDZUK7qvrPZ5xboZg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/js/i18n/datepicker.en.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.serializeJSON/3.2.1/jquery.serializejson.min.js" integrity="sha512-SdWDXwOhhVS/wWMRlwz3wZu3O5e4lm2/vKK3oD0E5slvGFg/swCYyZmts7+6si8WeJYIUsTrT3KZWWCknSopjg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    //jquery document ready
$(document).ready(function () {
    // calender methods
    $('#start').datepicker({
        language: 'en',
        minDate: new Date(),
        dateFormat: "d/mm/yyyy",
        autoClose: true
    });
    $('#end').datepicker({
        language: 'en',
        minDate: new Date(),
        dateFormat: "d/mm/yyyy",
        autoClose: true
    }); 
});

(function($) {
        // variables
        let customRules=
        {            
            adult: {
                required: true,
            },
            travelType: {
                required: true,
            },            
            travelDate: {
                required: true,
            },
            haveTrip:{
                required: true,
            },
            startDate:{
                required: true,
            },
            endDate:{
                required: true,
            },
            tripNameInput:{
                required: true,
            },
            tripNameSelect:{
                required: true,
            },
            name: {
                required: true,
            },
            email: {
                required: true,
                email : true
            },
            telephone: {
                required: true,
            },
            country:{
                required: true,
            }
        };
        
        var form = $("#signup-form");
        form.validate({
            errorPlacement: function errorPlacement(error, element) {
                if (error) {
                    let wrapper = document.querySelector('#errorWrapper');
                    wrapper.style.display = 'block';
                    let container = document.querySelector('.errorContainer');
                    container.innerHTML = error.text();
                }
            },
            rules: customRules,
            messages : {
                travelType: {
                    required: "Please select how are you planning to travel.",
                },
                adult: {
                    required: "Please enter the no. of adult travellers.",
                },
                travelDate: {
                    required: "Please select when you are planning to travel.",
                },
                email: {                
                    email: 'Not a valid email address <i class="zmdi zmdi-info"></i>'
                },
                startDate:{
                    required: "Please select start and end date.",
                },
                endDate:{
                    required: "Please select start and end date.",
                },
                tripNameInput:{
                    required: "Please enter the prefered trip name or location.",
                },
                tripNameSelect:{
                    required: "Please select the prefered trip name or location.",
                },
            },
            onfocusout: function(element) {
                $(element).valid();
            },
        });
        form.steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
        labels: {
            previous: 'Previous',
            next: 'Next',
            finish: 'Submit',
            current: ''
        },
        titleTemplate: '<div class="title"><span class="number">#index#</span>#title#</div>',
        onStepChanging: function(event, currentIndex, newIndex) {  
            form.validate().settings.ignore = ":disabled,:hidden";
            let wrapper = document.querySelector('#errorWrapper');
                wrapper.style.display = 'none';
            
            //if newIndex is smaller then currentIndex then return true 
            if (currentIndex > newIndex) {
                return true;
            }
            return form.valid();
        },
        onFinishing: function(event, currentIndex) {
            form.validate().settings.ignore = ":disabled, :hidden";
            // console.log(getCurrentIndex);
            let wrapper = document.querySelector('#errorWrapper');
            wrapper.style.display = 'none';
            return form.valid();
        },
        onFinished: function(event, currentIndex) {
            console.log(form.serializeJSON());
            //set display block to .loading div
            let loading = document.querySelector('.loading');
            loading.style.display = 'block';
            //set display none to .loading div

            fetch('/planTrip', {
                headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": $('input[name="_token"]').val()
            },
            method: "post",
            credentials: "same-origin",
            body: JSON.stringify(form.serializeJSON())
            }).then((response) =>{
                if (response.status === 200) {
                    loading.style.display = 'none';
                    return response.json();
                }
            }).then((data) => {                
                if (data.status === 'success') {
                    document.getElementById("signup-form").reset();
                    let wrapper = document.querySelector('#errorWrapper');
                    wrapper.style.display = 'block';
                    let container = document.querySelector('.errorContainer');
                    container.innerHTML = data.message;
                    //remove class .alert-danger from .errorContainer
                    container.classList.remove('alert-danger');
                    //add class .alert-success to .errorContainer
                    container.classList.add('alert-success');
                    //set timeout 3s
                    //reset form with jquery
                    setTimeout(function(){                        
                        //remove class .alert-success from .errorContainer
                        container.classList.remove('alert-success');
                        setTimeout(function(){
                            wrapper.style.display = 'none';
                        },3000);
                        window.location.href = '/thank-you';
                    }, 3000);
                    
                } else {
                    let wrapper = document.querySelector('#errorWrapper');
                    wrapper.style.display = 'block';
                    let container = document.querySelector('.errorContainer');
                    container.innerHTML = data.message;
                }
            }).catch((error) => {
                console.log(error);
            });
        // form.submit();
        },
    });

        // travel type
    $('.travelType').click(function(event) {
        let element = $('.travelType');
        for (let i = 0; i <= element.length; i++) {
            let radButton = $(element[i]).find('input[type=radio]');
            if (element.index(this) == i) {
                radButton.prop("checked", true); 
                radButton.parent().addClass('selected');
                if (radButton.val() == 3 || radButton.val() == 4) {
                    forGroup.style.display = 'block';
                    customRules.adult={
                        digits: true
                    }
                } 
                else {
                    forGroup.style.display = 'none';
                }
            } 
            else {
            radButton.parent().removeClass('selected');
            }
        }
    });  
    //travel date   
    $('.travelDate').click(function(event) {
        let element = $('.travelDate');
        for (let i = 0; i <= element.length; i++) {
            let radButton = $(element[i]).find('input[type=radio]');
            if (element.index(this) == i) {
                radButton.prop("checked", true); 
                radButton.parent().addClass('selected');
                let forDate = document.querySelector('#forDate');
                if (radButton.val() == 1 || radButton.val() == 2) {
                    forDate.style.display = 'block';
                } else {
                    forDate.style.display = 'none';
                }
            } 
            else {
                radButton.parent().removeClass('selected');
            }
        }
    });  
        //needHelp
    $('.needHelp').click(function(event) {
        let element = $('.needHelp');
        for (let i = 0; i <= element.length; i++) {
            let radButton = $(element[i]).find('input[type=radio]');
            if (element.index(this) == i) {
                radButton.prop("checked", true); 
                let forInput = document.querySelector('#forTripInput');
                let forSelect = document.querySelector('#forTripSelect');
                if (radButton.val() == 1) {
                    forInput.style.display = 'none';                    
                    forSelect.style.display = 'block';
                    forSelect.required = true;
                    $('#tripNameInput').val('');
                    $('#destinationDescription').val('');
                } else {                    
                    forInput.style.display = 'block';
                    forSelect.style.display = 'none';
                    forInput.required = true;
                    $("#tripNameSelect").prop('selectedIndex', 0);
                } 
            }
        }
    }); 
})(jQuery);

</script>
@endpush
@push('styles')
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
    integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/air-datepicker/2.2.3/css/datepicker.min.css">
@endpush