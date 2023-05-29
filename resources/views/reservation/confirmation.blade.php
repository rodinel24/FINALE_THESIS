<h1>Reservation Created Successfully!</h1>
<p>Thank you for your reservation.</p>

@foreach ($users as $user)
    <p>Email: {{$user->email}}</p>
@endforeach
