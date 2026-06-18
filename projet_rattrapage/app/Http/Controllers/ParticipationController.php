<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParticipationController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $user = Auth::user();
        $events = $user->participations()->with(['category', 'address'])->orderBy('date', 'asc')->get();

        return view('participations.index', compact('events'));
    }
    public function store(Request $request, Event $event)
    {
        $this->authorize('participate', $event);

        if ($event->date->isPast()) {
            return redirect()->back()->with('error', "Désolé, cet événement est déjà terminé.");
        }
        
        if ($event->volunteers()->count() >= $event->max_volunteers) {
            return redirect()->back()->with('error', "desole l'evenement est pleine");
        }
        $event->volunteers()->attach(Auth::id());
        return redirect()->back();
    }
    public function destroy(Event $event)
    {
        $event->volunteers()->detach(Auth::id());
        return redirect()->back();
    }
}
