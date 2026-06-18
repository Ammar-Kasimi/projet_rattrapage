<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use App\Models\Address;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        if ($request->filled('category_id')) {
            $events = Event::with(['address', 'category'])->where('category_id', $request->category_id)->withCount('volunteers')->orderBy('date', 'asc')->get();
        } else {
            $events = Event::with(['address', 'category'])->withCount('volunteers')->orderBy('date', 'asc')->get();
        }

        return view('events.index', compact('events', 'categories'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('events.create', compact('categories'));
    }

    public function store(EventRequest $request)
    {
        $picturePath = null;
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('events', 'public');
        }
        $validated = $request->validated();
        $address = Address::create($validated);
        $validated['picture'] = $picturePath;
        $address->events()->create($validated);

        // return redirect()->route('events.index');
        return redirect()->route('admin.dashboard');
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
        if ($request->max_volunteers < $event->volunteers()->count()) {
            return back()->withErrors([
                'max_volunteers' => 'Impossible :le nombre de benevoles deja inscrit est plus grand que ce max_benevoles'
            ])->withInput();
        }
        $validated = $request->validated();
        if ($request->hasFile('picture')) {
            if ($event->picture) {
                Storage::disk('public')->delete($event->picture);
            }
            $picturePath = $request->file('picture')->store('events', 'public');
            $validated['picture'] = $picturePath;
        }
        
        $event->address->update($validated);
        $event->update($validated);
        // return redirect()->route('events.index');
        return redirect()->route('admin.dashboard');
    }
    public function destroy(Event $event)
    {
        if ($event->picture) {
            Storage::disk('public')->delete($event->picture);
        }
        $event->delete();

        // return redirect()->route('events.index');
        return redirect()->route('admin.dashboard');
    }
    public function dashboard()
    {
        $events = Event::with('category')->withCount('volunteers')->get();
        $categories = Category::all();
        return view('admin.dashboard', compact('events', 'categories'));
    }
}
