<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.9/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/themes/material_blue.css">
    <link rel="stylesheet" href="booking.css">


    @vite('resources/sass/app.scss')
</head>

<body>
      
            <!-- Sidebar -->

            <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
                    <body style="background-color: #0F1521;">

<header class="flex items-center justify-between py-4 px-6 bg-#0F1521  mb-3 "  style="border-bottom:10px;">

        <div class="flex items-center">
            <a href="{{url('/')}}">
                <img class="h-20" src="/img/msat.png" alt=" Logo">
            </a>
            <h1 class="ml-4 text-2xl font-bold text-white">Dr. Magadapa Ali Ringia Hotel</h1>
            <div class="text-left" style="margin-left:0.8cm; line-height:1;">
  <p class="text-white font-medium">MSU-MSAT, Maigo, Lanao del Norte, Philippines, 9206</span>
    <br>Telephone Number:  <span class="text-blue-500 italic"> 227-4208<br></span>
 <span class="text-black-700 font-medium"> Email: <span class="text-blue-500 italic">Dr.magadapaaliringia@gmail.com</span></p>
</div>
        <div class="flex items-center" style="margin-left:10cm;">
            <ul class="text-gray-600">
            <li class="text-blue-500 text- text-lg italic underline font-bold">Choose Room</li>

            </ul>
        </div>
        </div>
    </header>
<div class="bg-white mb-3" style="border-radius:20px; position:sticky;"><br></div>

    </body>

<body>
    
@include('reservationOnline.reservation.progressbar')
<div class="container mt-3">
    <div class="row justify-content-md-center">
        <div class="col-md-8 mt-2">
            <div class="card shadow-sm border">
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row mb-3">
                                <label for="room_number" class="col-sm-2 col-form-label">Room Number</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="room_number" name="room_number"
                                        placeholder="col-form-label" value="{{ $room->number }} " readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="room_type" class="col-sm-2 col-form-label">Type</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="room_type" name="room_type"
                                        placeholder="col-form-label" value="{{ $room->type->name }} " readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="room_capacity" class="col-sm-2 col-form-label">Capacity</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="room_capacity" name="room_capacity"
                                        placeholder="col-form-label" value="{{ $room->capacity }} " readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="room_price" class="col-sm-2 col-form-label">Price / Day</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="room_price" name="room_price"
                                        placeholder="col-form-label"
                                        value="{{ $room->price }}" readonly>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-sm-12 mt-2">
                            <form method="POST"
                                action="{{ route('reservationOnline.reservation.payDownPayment', ['customer' => $customer->id, 'room' => $room->id]) }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="check_in" class="col-sm-2 col-form-label">Check In</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="check_in" name="check_in"
                                            placeholder="col-form-label" value="{{ $stayFrom }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="check_out" class="col-sm-2 col-form-label">Check Out</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="check_out" name="check_out"
                                            placeholder="col-form-label" value="{{ $stayUntil }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="how_long" class="col-sm-2 col-form-label">Duration of Stay</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="how_long" name="how_long"
                                            placeholder="col-form-label"
                                            value="{{ $dayDifference }} {{ Helper::plural('Day', $dayDifference) }} "
                                            readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="total_price" class="col-sm-2 col-form-label">Total Price</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="total_price" name="total_price"
                                            placeholder="col-form-label"
                                            value="{{ Helper::getTotalPayment($dayDifference, $room->price) }} "
                                            readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="minimum_dp" class="col-sm-2 col-form-label">Minimum Down Payment</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="minimum_dp" name="minimum_dp"
                                            placeholder="col-form-label"
                                            value="{{ $downPayment}} " readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
    <label for="mode_of_payment" class="col-sm-2 col-form-label">Mode of Payment</label>
    <div class="col-sm-10">
        <select class="form-select" id="mode_of_payment" name="mode_of_payment">
            <option value="">Select mode of payment</option>
            <option value="bank_transfer">Bank Transfer</option>
            <option value="gcash">Gcash</option>
        </select>
    </div>
</div>
<div class="row mb-3">
    <div class="col-sm-5 ms-5">
        <span data-bs-toggle="modal" data-bs-target="#imageModal1">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal1" data-bs-target="#imageModal1">
                GCash Account
            </button>
        </span>
    </div>
    <div class="col-sm-6">
        <span data-bs-toggle="modal" data-bs-target="#imageModal2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal2" data-bs-target="#imageModal2">
                Bank Account
            </button>
        </span>
    </div>
</div>

<!-- Modal 1 -->
<div class="modal fade" id="imageModal1" tabindex="-1" aria-labelledby="imageModal1Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img src="/img/gcash.jpg" alt="Image 1" class="img-fluid" >
            </div>
        </div>
    </div>
</div>

<!-- Modal 2 -->
<div class="modal fade" id="imageModal2" tabindex="-1" aria-labelledby="imageModal2Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <img src="/img/landbank.png" alt="Image 2" class="img-fluid">
            </div>
        </div>
    </div>
</div>

                                
                                <div class="row mb-3">
                                    <label for="downPayment" class="col-sm-2 col-form-label">Payment</label>
                                    <div class="col-sm-10">
                                        <input type="text"
                                            class="form-control @error('downPayment') is-invalid @enderror"
                                            id="downPayment" name="downPayment" placeholder="Input payment here"
                                            value="{{ old('downPayment') }}">
                                        @error('downPayment')
                                            <div class="text-danger mt-1">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10" id="showPaymentType"></div>
                                </div>
                                <button type="submit" class="btn btn-primary float-end">Confirm</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mt-4">
            <div class="card shadow-sm border rounded-3">
                <div class="card-body">
                    <div class="text-center">
                    <div class="d-flex justify-content-center align-items-center">
                        <img src="{{ $customer->user->getAvatar() }}" class="img-fluid rounded-circle mb-3" style="width: 100px; height: 100px;">
                    </div>

                        
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <p class="card-text"><strong>Name:</strong>{{ Str::ucfirst($customer->name) }}</p>
                        </div>
                        <div class="col-6">
                            <p class="card-text"><strong>Gender:</strong>{{ Str::ucfirst($customer->gender == 'Male' ? 'Male' : 'female') }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p class="card-text"><strong>Birthdate:</strong>{{ Str::ucfirst($customer->birthdate)  }}</p>
                        </div>
                        <div class="col-6">
                            <p class="card-text"><strong>Address:</strong>{{ Str::ucfirst( $customer->address )}}</p>


             
            <!-- /#page-content-wrapper -->

          



    </main>
    @vite('resources/js/app.js')
</body>

</html>
