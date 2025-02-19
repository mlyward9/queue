<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormQueue;

class FormController extends Controller
{
    // Show the form page
    public function showForm()
    {
        return view('form'); // Ensure this matches the Blade template name
    }

    // Handle form submission
    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'purpose' => 'required|array',
            'purpose.*' => 'in:e-registration,oec,information_sheet,welfare_registration_and_division,direct_hire,SENA',
        ]);

        FormQueue::create([
            'name' => $request->input('name'),
            'gender' => $request->input('gender'),
            'purpose' => $request->input('purpose'),
            'status' => 'waiting',
            'completed' => false,
        ]);

        return back()->with('success', 'Form submitted successfully! Selected purposes: ' . implode(', ', $request->input('purpose')));
    }
}
