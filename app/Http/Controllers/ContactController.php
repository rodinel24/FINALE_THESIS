<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'message' => 'required',
        ]);

        // Create a new contact record
        $contact = new Contact;
        $contact->name = $validatedData['name'];
        $contact->email = $validatedData['email'];
        $contact->phone_number = $validatedData['phone_number'];
        $contact->message = $validatedData['message'];
        $contact->save();

        // Redirect back to the form with a success message
        return redirect()->back()->with('success', 'Your message has been sent.');
    }
}

