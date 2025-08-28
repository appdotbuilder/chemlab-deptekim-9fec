<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TicketsPassword;
use Illuminate\Http\Request;

class ForgotPasswordTicketController extends Controller
{
    /**
     * Store a password help ticket.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'reason' => ['nullable', 'string', 'max:1000'],
        ]);

        $user = User::where('email', $request->email)->first();

        // Create a password help ticket regardless if user exists, for security reasons
        TicketsPassword::create([
            'user_id' => $user?->id, // Nullable user_id if email doesn't exist
            'ticket_code' => TicketsPassword::generateTicketCode(),
            'reason' => $request->reason,
            'status' => 'open',
        ]);

        return redirect()->back()->with('success', 'Permintaan bantuan password dibuat. Admin/Laboran akan memproses.');
    }
}