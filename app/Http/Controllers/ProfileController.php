<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Module;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');


    }/**
     * Display the student's dashboard with their enrolled modules. (Chris dashboard)
     */
    public function dashboard(): View
    {
        // Fetch the currently authenticated user
        $user = auth()->user();

        // Ensure the user is a student
        if ($user->student) {
            // Get the modules the student is enrolled in
            $modules = $user->student->modules;

            // Check if modules is not null and convert to empty collection if null
            $modules = $modules ?? collect();

            // Pass the modules to the view
            return view('dashboard', compact('modules'));
        }

        // If the user is not a student, redirect to a different page
        return redirect()->route('home');
    }
}