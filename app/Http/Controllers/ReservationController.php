<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\UserRepository;


class ReservationController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function index()
    {
        $reservations = Reservation::all();
        return view('reservation.index', compact('reservations'));
    }

    public function confirm(Reservation $reservation)
    {
        $reservation->confirmed = true;
        $reservation->save();

        return redirect()->route('reservations.index');
    }

    public function reject(Reservation $reservation)
    {
        $reservation->confirmed = false;
        $reservation->save();

        return redirect()->route('reservations.index');
    }

    public function create()
{
    return view('reservation.create');
}

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $reservation = new Reservation([
        'name' => $request->get('name'),
        'start_date' => $request->get('start_date'),
        'end_date' => $request->get('end_date'),
        'confirmed' => false
    ]);
  

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('reservation_images');
        $reservation->image = $imagePath;
    }

    $reservation->save();

    return redirect()->route('reservations.confirmation');
}
public function confirmation(Request $request)
    {
        $users = $this->userRepository->showUser($request);
        $customers = $this->userRepository->showCustomer($request);
        return view('reservation.confirmation' ,  compact('users', 'customers'));
    }
}
