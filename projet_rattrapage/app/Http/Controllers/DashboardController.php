<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Participation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   
    public function dashboard(Request $request)
    {
        // $events = Event::with('category')->withCount('volunteers')->get();
        $categories = Category::all();
        $totalEvents = Event::count();
        // $totalVolunteers = Event::withCount('volunteers')->get()->sum('volunteers_count');
        $totalVolunteers = Participation::count();
        $query = Event::with(['address', 'category'])->withCount('volunteers');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('month')) {
            $year = date('Y', strtotime($request->month));
            $month = date('m', strtotime($request->month));
            $query->whereYear('date', $year)->whereMonth('date', $month);
        }
        $events = $query->orderBy('date', 'asc')->get();
        return view('admin.dashboard', compact('events', 'categories', 'totalEvents', 'totalVolunteers'));
    }

}
