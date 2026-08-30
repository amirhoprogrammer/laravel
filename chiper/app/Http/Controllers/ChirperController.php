<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$chirps = [
        //    [
        //        'author' => 'Jane Doe',
        //        'message' => 'Just deployed my first Laravel app! 🚀',
        //        'time' => '5 minutes ago'
        //    ],
        //    [
        //        'author' => 'John Smith',
        //        'message' => 'Laravel makes web development fun again!',
        //        'time' => '1 hour ago'
        //    ],
        //    [
        //        'author' => 'Alice Johnson',
        //        'message' => 'Working on something cool with Chirper...',
        //        'time' => '3 hours ago'
        //    ]
        //];

        //return view('home', ['chirps' => $chirps]);
        $chirps = Chirp::with("user")
            ->latest()
            ->take(50)
            ->get();

        return view("home", ['chirps' => $chirps]);
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
        // Validate the request
        $validated = $request->validate([
            'message' => 'required|string|max:255|min:5',
        ], [
            'message.required' => 'Please write something to chirp!',
            'message.max' => 'Chirps must be 255 characters or less.',
        ]);

        // Create the chirp (no user for now - we'll add auth later)
        Chirp::create([
            'message' => $validated['message'],
            'user_id' => null, // We'll add authentication in lesson 11
        ]);

        // Redirect back to the feed
        return redirect('/')->with('success', 'Chirp created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        // We'll add authorization in lesson 11
        return view('chirps.edit', compact('chirp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        if ($request->user()->cannot('update', $chirp)) {
            abort(403);
        }
        //$this->authorize('update', $chirp);
        // Validate the request
        $validated = $request->validate([
            'message' => 'required|string|max:255|min:5',
        ], [
            'message.required' => 'Please write something to chirp!',
            'message.max' => 'Chirps must be 255 characters or less.',
        ]);

        $chirp->update($validated);

        // Redirect back to the feed
        return redirect('/')->with('success', 'Your chirp Updated');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //$this->auth
        ////authorize('delete', $chirp);
        $chirp->delete();

        // delete
        return redirect('/')->with('success', 'Your chirp has been deleted');
    }
}