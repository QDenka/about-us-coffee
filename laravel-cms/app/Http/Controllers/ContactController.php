<?php

namespace App\Http\Controllers;

use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $ip = $request->ip();
        $email = $request->input('email');

        // Rate limiting by IP and email
        $rateLimitKey = 'contact-form:' . $ip;
        $emailLimitKey = 'contact-email:' . $email;

        if (RateLimiter::tooManyAttempts($rateLimitKey, 3)) {
            throw ValidationException::withMessages([
                'rate_limit' => 'Too many submissions from this IP. Please try again later.',
            ]);
        }

        if (RateLimiter::tooManyAttempts($emailLimitKey, 2)) {
            throw ValidationException::withMessages([
                'email' => 'Too many submissions from this email. Please try again later.',
            ]);
        }

        // Honeypot check
        if ($request->filled('website')) {
            RateLimiter::hit($rateLimitKey, 3600);
            return response()->json(['success' => true]); // Fake success for bots
        }

        // Validation
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|min:2',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000|min:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        // Check for rate limiting in database
        if (ContactSubmission::isRateLimited($ip, $email)) {
            throw ValidationException::withMessages([
                'rate_limit' => 'Too many recent submissions. Please wait before sending another message.',
            ]);
        }

        // Simple spam detection
        $message = strtolower($request->input('message'));
        $spamWords = ['bitcoin', 'crypto', 'investment', 'loan', 'casino', 'viagra', 'porn'];
        $isSpam = false;
        
        foreach ($spamWords as $word) {
            if (str_contains($message, $word)) {
                $isSpam = true;
                break;
            }
        }

        // Create submission
        $submission = ContactSubmission::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
            'ip_address' => $ip,
            'user_agent' => $request->userAgent(),
            'status' => $isSpam ? 'spam' : 'unread',
        ]);

        // Hit rate limiters only after successful submission
        RateLimiter::hit($rateLimitKey, 3600); // 1 hour
        RateLimiter::hit($emailLimitKey, 3600);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for your message! We will get back to you soon.',
        ]);
    }
}
