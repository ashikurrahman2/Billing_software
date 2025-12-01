<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Bill;
use App\Models\Customer;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        // Statistics calculations - BEFORE return statement
        $totalBills     = Bill::count();
        $totalSales     = Bill::sum('grand_total');
        $todaySales     = Bill::whereDate('date', today())->sum('grand_total');
        $thisMonthSales = Bill::whereMonth('date', now()->month)
                              ->whereYear('date', now()->year)
                              ->sum('grand_total');
        $totalCustomers = Customer::count();
        $totalDue       = Bill::whereIn('status', ['due', 'partial'])->sum('grand_total');

        return view('profile.edit', [
            'user' => $request->user(),
            'totalBills' => $totalBills,
            'totalSales' => $totalSales,
            'todaySales' => $todaySales,
            'thisMonthSales' => $thisMonthSales,
            'totalCustomers' => $totalCustomers,
            'totalDue' => $totalDue,
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
    }
}