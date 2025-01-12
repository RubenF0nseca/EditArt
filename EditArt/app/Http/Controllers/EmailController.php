<?php

namespace App\Http\Controllers;

use App\Mail\EmailEditArt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Validate input data
        $validatedData = $request->validate([
            'subject' => 'required|string|max:255', // Validate subject
            'content' => 'required|string',         // Validate content
            'files' => 'nullable|file|mimes:pdf,jpg,png,docx', // Validate file
        ]);

        $attachment = $request->hasFile('files') ? $request->file('files') : null;

        $users = User::all(); // Fetch all users to send emails

        foreach ($users as $user) {
            Mail::to($user->email)->send(new EmailEditArt(
                $validatedData['subject'],
                $validatedData['content'],
                $attachment
            ));
        }

        return back()->with('success', 'Emails sent successfully!');
    }
}
