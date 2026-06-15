<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Address;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['address', 'category'])->withCount('volunteers')->get();
        if (Auth::user()->role === 'admin') {
            $categories = Category::all();
            return view('admin.dashboard', compact('events', 'categories'));
        }
        return view('events.index', compact('events'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('events.create', compact('categories'));
    }

    public function store(EventRequest $request)
    {
        $validated = $request->validated();
        $address = Address::create($validated);
        $address->events()->create($validated);

        return redirect()->route('events.index');
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }
    public function edit(Event $event)
    {
        $categories = Category::all();
        return view('events.edit', compact('event', 'categories'));
    }
    public function update(EventRequest $request, Event $event)
    {
        $validated = $request->validated();
        $event->address->update($validated);
        $event->update($validated);
        return redirect()->route('events.index');
    }
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index');
    }
}
