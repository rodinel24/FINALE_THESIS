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
 <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background-color: #f7f7f7;
            border: 1px solid #e2e2e2;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            color: #333333;
            font-size: 28px;
            margin: 0;
            padding: 0;
            text-transform: uppercase;
        }

        .message {
            margin-bottom: 30px;
        }

        .message p {
            color: #666666;
            font-size: 16px;
            line-height: 24px;
            margin: 0;
            padding: 0;
        }

        .footer {
            text-align: center;
            margin-top: 30px;
            color: #888888;
            font-size: 14px;
        }
        
        .footer a {
            color: #888888;
            text-decoration: none;
        }
        
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body style="background-color: #0F1521; ">

<header class="flex items-center justify-between py-4 px-6 bg-#0F1521  mb-3" style="position:sticky;">
        <div class="flex items-center">
            <a href="{{url('/')}}">
                <img class="h-20" src="/img/msat.png" alt="Hotel Logo">
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

    <div class="container mt-5" style="margin-top:100px;">
    <div class="row justify-content-center" >
        <div class="col-lg-6 col-md-8 col-sm-10 " >
             <div class="container">
        <div class="header">
            <h2>Reservation Confirmation</h2>
        </div>
        <div class="message">
            <p>Thank you for making a reservation. We will send a confirmation email to the provided email address.</p>
            <p>Please check your email for further details and instructions.</p>
        </div>
        <div class="footer">
            <p>For any inquiries, please <a href="mailto:drringiahotel.03@gmail.com">contact our support team</a>.</p>
        </div>
    </div>
                    </div>
                </div>
            </div>

           
        </div

        

    