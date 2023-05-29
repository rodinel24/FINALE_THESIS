@extends('template.master')
@section('title', 'Create Identity')
@section('head')
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection
@section('content')
    @include('transaction.reservation.progressbar')
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                <div class="card shadow-sm border">
                    <div class="card-header">
                        <h2>Add Customer</h2>
                    </div>
                    <div class="card-body p-3">
                        <form class="row g-3" method="POST" action="{{ route('transaction.reservation.storeCustomer') }}"
                            enctype="multipart/form-data">
                            @csrf
                                                
                        <div id="error-messages">

                        <div class="col-md-12">
                            <label for="name" class="form-label">Full Name</label>
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
                                <input type="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email">
                                @error('email')
                                    <div class="text-danger mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        <div class="col-md-12">

                            <label for="birthdate" class="form-label">Date of Birth </label>
                            
                            <input type="date" class="form-control @error('birthdate') is-invalid @enderror"
                                id="birthdate" name="birthdate" value="{{ old('birthdate') }}"
                                max="{{ \Carbon\Carbon::now()->subYears(18)->format('Y-m-d') }}">
                                    
                                @error('birthdate')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" aria-label="Default select example">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Non-binary">Non-binary</option>
                                <option value="Transgender">Transgender</option>
                                <option value="Genderqueer">Genderqueer</option>
                                <option value="Other">Other</option>
                            </select>
                            @error('gender')
                                <div class="text-danger mt-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="contact_number" class="form-label">Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-text">+63</span>
                                <input type="tel" pattern="[0-9]{10}" inputmode="numeric" class="form-control @error('contact_number') is-invalid @enderror" id="contact_number"
                                    name="contact_number" value="{{ old('contact_number') }}" maxlength="10" required>
                            </div>
                            @error('contact_number')
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
            <script>
     

      $(document).ready(function() {
    $('#email').on('input', function() {
        var emailInput = $(this);
        var email = emailInput.val();

        // Check if the entered email matches the pattern
        if (!isValidEmail(email)) {
            emailInput.addClass('is-invalid');
        } else {
            emailInput.removeClass('is-invalid');
        }
    });

    function isValidEmail(email) {
        // Regular expression for email validation
        var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        return emailPattern.test(email);
    }
});

$(document).ready(function() {
    $('#name').on('input', function() {
        var nameInput = $(this);
        var name = nameInput.val();

        // Remove any characters that are not letters or spaces
        var sanitizedInput = name.replace(/[^A-Za-z\s]/g, '');

        // Update the input value with the sanitized version
        nameInput.val(sanitizedInput);
    });
});

$(document).ready(function() {
    $('#contact_number').on('input', function() {
        var numberInput = $(this);
        var number = numberInput.val();

        // Remove any non-numeric characters
        var sanitizedInput = number.replace(/\D/g, '');

        // Update the input value with the sanitized version
        numberInput.val(sanitizedInput);
    });
});
    </script>
        </div>
    </div>
@endsection
