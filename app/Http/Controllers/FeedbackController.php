<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = \App\Models\Feedback::latest()->get();
        return view('admin.feedback', compact('feedbacks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'page' => 'nullable|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string',
        ]);

        \App\Models\Feedback::create($validated);

        return response()->json(['success' => 'Thank you for your feedback!']);
    }
}
