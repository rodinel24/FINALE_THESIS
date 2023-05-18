<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel Booking Process</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.9/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/themes/material_blue.css">
    <link rel="stylesheet" href="booking.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
header{


    border-bottom:10px!important;
    border-color:white!important;
}


</style>
</head>
<body style="background-color: #0F1521; ">

<header class="flex items-center justify-between py-4 px-6 bg-#0F1521  mb-3" style="position:sticky;">
        <div class="flex items-center">
            <a href="{{url('/')}}">
                <img class="h-20" src="../img/logo/logo.png" alt="Hotel Logo">
            </a>
            <h1 class="ml-4 text-2xl font-bold text-white">Dr. Magadapa Ali Ringia Hotel</h1>
            <div class="text-left" style="margin-left:0.8cm; line-height:1;">
  <p class="text-white font-medium">MSU-MSAT, Maigo, Lanao del Norte, Philippines, 9206</span>

    <br>
 Telephone Number:  <span class="text-blue-500 italic"> 227-4208<br></span>
 <span class="text-black-700 font-medium"> Email: <span class="text-blue-500 italic">Dr.magadapaaliringia@gmail.com</span></p>
</div>
        <div class="flex items-center" style="margin-left:10cm;">
            <ul class="text-gray-600">
            <li class="text-blue-500 text- text-lg italic underline font-bold">Number of Reservation</li>

            </ul>
        </div>
        </div>
    </header>
<div class="bg-white mb-3" style="border-radius:20px; position:sticky;"><br></div>

</body>
@section('title', 'Count Person')
@section('head')
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
@endsection
@vite('resources/sass/app.scss')
@include('reservationOnline.reservation.progressbar')

    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-10">
            <div class="card shadow-sm border rounded-3">
                <div class="card-body p-4">
                    <h2 class="card-title mb-4 text-center">Make a Reservation</h2>
                    <form class="row g-3" method="GET" action="{{ route('reservationOnline.reservation.chooseRoom', ['customer' => $customer->id]) }}">
                        <div class="col-md-12">
                            <label for="count_person" class="form-label">Total Number of Guests</label>
                            <input type="number" placeholder="Maximum value: 150"max="150" class="form-control rounded-3 @error('count_person') is-invalid @enderror" id="count_person" name="count_person" value="{{ old('count_person') }}" placeholder="Enter number of guests">
                            @error('count_person')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="check_in" class="form-label">Check-in Date</label>
                            <input type="date" class="form-control rounded-3 @error('check_in') is-invalid @enderror" id="check_in" name="check_in" value="{{ old('check_in') }}" placeholder="Select check-in date">
                            @error('check_in')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="check_out" class="form-label">Check-out Date</label>
                            <input type="date" class="form-control rounded-3 @error('check_out') is-invalid @enderror" id="check_out" name="check_out" value="{{ old('check_out') }}" placeholder="Select check-out date">
                            @error('check_out')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-lg btn-primary shadow-sm rounded-pill px-5 py-2">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mt-4">
            <div class="card shadow-sm border rounded-3">
                <div class="card-body">
                    <div class="text-center">
                    <div style="display: flex; justify-content: center;">
                        <img src="{{ $customer->user->getAvatar() }}" class="img-fluid rounded-circle mb-3" style="width: 100px; height: 100px;">
                        </div>
                        <h4 class="card-title"> Name: {{ $customer->name }} </h4>
                        <p class="card-text">Job: {{ $customer->job }}</p>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <p class="card-text">Birthdate: {{ $customer->birthdate }}</p>
                        </div>
                        <div class="col-6">
                            <p class="card-text">Address: {{ $customer->address }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(function() {
            // Set the maximum date for the check-out input field to one year from the current date
            var maxDate = new Date();
            maxDate.setFullYear(maxDate.getFullYear() + 1);
            var maxDateString = maxDate.toISOString().slice(0,10);
            $('#check_out').attr('max', maxDateString);
            $('#check_in').attr('max', maxDateString);
            
            // Validate the check-out date when the form is submitted
            $('form').submit(function() {
                var checkInDate = $('#check_in').val();
                var checkOutDate = $('#check_out').val();
                if (new Date(checkOutDate) < new Date(checkInDate)) {
                    alert('Please select a check-out date that is after the check-in date.');
                    return false; // Prevent the form from submitting
                }
                if (new Date(checkOutDate) > maxDate) {
                    alert('Please select a check-out date within one year from today.');
                    return false; // Prevent the form from submitting
                }
            });
        });


            </script>
        </div

        

    