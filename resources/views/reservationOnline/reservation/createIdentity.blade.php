
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

</head>
<body>
<header class="flex items-center justify-between py-4 px-6 bg-#0F1521 shadow-md mb-3">
        <div class="flex items-center">
            <a href="{{url('/')}}">
                <img class="h-20" src="../img/logo/logo.png" alt="Hotel Logo">
            </a>
            <h1 class="ml-4 text-2xl font-bold text-white">Dr. Magadapa Ali Ringia Hotel</h1>
            <div class="text-left" style="margin-left:0.8cm; line-height:1;">
  <p class="text-white font-medium">MSU-MSAT, Maigo, Lanao del Norte, Philippines, 9206</span>

    <br>
 Telephone Number:  <span class="text-blue-500 italic"> 227-4208<br></span>
 <span class="text-black-700 font-medium"> Email: <span class="text-blue-500 italic"  id="email-link" onclick="goToEmail">Dr.magadapaaliringia@gmail.com</span></p>
</div>
        <div class="flex items-center" style="margin-left:10cm;">
            <ul class="text-gray-600">
            <li class="text-blue-500 text- text-lg italic underline font-bold">Peronal Information</li>

            </ul>
        </div>
        </div>
    </header>
    <script>
       function goToEmail() {
      var sender = 'My Name'; // replace with the sender's name
      var url = 'https://mail.google.com/mail/?view=cm&fs=1&to=drringiahotel.03@gmail.com&su=Subject&body=';
      url += encodeURIComponent('Sent from ' + sender + '\n\n'); // add the sender's name to the email body
      window.open(url, '_blank'); // open the email link in a new tab/window
      }

      $(document).ready(function() {
      $('#email-link').click(function(e) {
         e.preventDefault(); // prevent the default behavior of the link
         goToEmail(); // call the goToEmail function
      });
      });



    </script>

</body>


<script src="booking.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


</html>

  
<div class="red-container">


@section('title', 'Create Identity')
@section('head')
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">

@endsection
@vite('resources/sass/app.scss')

    @include('reservationOnline.reservation.progressbar')
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <div class="card shadow-sm border">
                    <div class="card-header">
                        <h2>Personal Information</h2>
                    </div>
                    <div class="card-body p-3">
                    <form id="customer-form" class="row g-3" method="POST" action="/storeCustomerOnline" enctype="multipart/form-data">

                            @csrf
                            <div id="error-messages">

                            <div class="col-md-12">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"  id=" email"
                                    name="email" >
                                @error('email')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="birthdate" class="form-label">Date of birth</label>
                                <input type="date" class="form-control @error('birthdate') is-invalid @enderror"
                                    id="birthdate" name="birthdate" value="{{ old('birthdate') }}">
                                @error('birthdate')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" aria-label="Default select example">
                                    {{-- <option selected hidden>Select</option> --}}
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                @error('gender')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="job" class="form-label">Job</label>
                                <input type="text" class="form-control @error('job') is-invalid @enderror" id="job"
                                    name="job" value="{{ old('job') }}">
                                @error('job')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address"
                                    rows="3">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- <div class="col-mg-12">
                                <label for="avatar" class="form-label">Profile Picture</label>
                                <input class="form-control" type="file" name="avatar" id="avatar">
                                @error('avatar')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div> -->
                            <div class="col-12">
                                <button type="submit" class="btn myBtn shadow-sm border float-end">Next</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
        </div>
      </div>
    
  </div>






	<!-- rest of the HTML code for the booking process goes here -->