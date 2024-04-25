<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('teams.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "description" => "required|string",
        ]);

        $team = Team::create([
            'user_id' => $request->user()->id,
            "name" => $request->name,
            "description" => $request->description,
            "image" => "images/team-bg-" . rand(1, 6) . ".jpg"
        ]);
        $team->members()->attach($request->user());

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        return view('teams.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }

    public function invite(Request $request, Team $team)
    {
        $request->validate([
            'email' => "required",
        ]);


        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'user with email ' . $request->email . ' not found!');
        }

        $members = $team->members->map(fn($member) => $member->id)->toArray();
        if (in_array($user->id, $members)) {
            return back()->with('error', $user->name . ' already here!');
        }

        $team->members()->attach($user);
        return back()->with('success', $user->name . ' invited to ' . $team->name);
    }
}
