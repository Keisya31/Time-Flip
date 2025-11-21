<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    // Menampilkan halaman utama dengan semua events
    public function index()
    {
        $events = Event::orderBy('event_date', 'asc')->get();
        return view('events.index', compact('events'));
    }

    // Membuat event baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'event_date' => 'required|date|after:now',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $event = Event::create([
            'name' => $request->name,
            'event_date' => $request->event_date,
        ]);

        return redirect()->route('events.index')->with('success', 'Event created!');

    }

    // Menghapus event
    public function destroy($id)
    {
        $event = Event::find($id);
        
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 404);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted');
    }

    // Mengambil detail event (untuk countdown modal)
    public function show($id)
    {
        $event = Event::find($id);
        
        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'event' => $event
        ]);
    }
}