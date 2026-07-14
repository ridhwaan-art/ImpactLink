<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organization;
use App\Models\Project;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $term = $request->input('q');
        $results = [];

        if ($term) {
            $results['volunteers'] = Volunteer::where('first_name', 'like', '%'.$term.'%')->orWhere('last_name', 'like', '%'.$term.'%')->take(5)->get();
            $results['projects'] = Project::where('title', 'like', '%'.$term.'%')->take(5)->get();
            $results['events'] = Event::where('title', 'like', '%'.$term.'%')->take(5)->get();
            $results['organizations'] = Organization::where('name', 'like', '%'.$term.'%')->take(5)->get();
        }

        return view('search.index', compact('results', 'term'));
    }
}
