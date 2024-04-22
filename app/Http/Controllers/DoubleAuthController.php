<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DoubleAuthController extends Controller
{
    public function index()
    {
        Gate::authorize('update-double-auth');
        return view('auth.double-auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            "verification_code" => "required|min:8|max:8"
        ]);

        $user = $request->user();

        if ($request->verification_code == $user->verification_code) {
            $user->update([
                "verification_code" => null
            ]);

            return redirect()->intended(route('dashboard', absolute: false));
        }

        return back();
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $user->update([
            'double_auth' => !$user->double_auth,
        ]);

        return back();
    }
}
