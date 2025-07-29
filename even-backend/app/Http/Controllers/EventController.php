<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
   public function index(Request $request)
   {
        $filter = $request->query('filter', 'today');

        $query = Event::query();

        match ($filter) {
            'past' => $query->where('date', '<', now()->toDateString()),
            'future' => $query->where('date', '>', now()->toDateString()),
            default => $query->whereDate('date', now()->toDateString()),
        };

        return response()->json($query->orderBy('date')->orderBy('time')->get());
   }
}
