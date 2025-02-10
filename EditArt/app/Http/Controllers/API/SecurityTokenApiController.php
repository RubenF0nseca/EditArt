<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class SecurityTokenApiController extends Controller
{
    /**
     * Check if the security token exists and send a reset password link to the user's email.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkToken(Request $request)
    {
        // Validate the token input
        $request->validate([
            'security_token' => 'required|string|size:6',
        ]);

        // Retrieve the user with the provided security token
        $user = User::where('security_token', $request->security_token)->first();

        // Check if the user exists
        if ($user) {
            // Send password reset link
            $status = Password::sendResetLink(
                ['email' => $user->email]
            );

            // Check the result of the password reset link sending process
            if ($status === Password::RESET_LINK_SENT) {
                return response()->json([
                    'success' => true,
                    'message' => 'Password reset link sent to your email.'
                ], 200);
            }

            // If there is an error sending the link
            return response()->json([
                'success' => false,
                'message' => 'Failed to send reset link.'
            ], 500);
        }

        // If the user is not found
        return response()->json([
            'success' => false,
            'message' => 'Token not found or invalid.'
        ], 404);
    }
}
