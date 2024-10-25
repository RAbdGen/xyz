<?php

namespace App\Http\Controllers;

use App\Models\Week;
use App\Models\Track;

class HomeController extends Controller
{
    /**
     * App homepage.
     */
    public function __invoke()
    {
        return view('app.home', [
            'week' => Week::current()->loadCount('tracks'),
            'tracks' => Track::currentWeek()->with('week')->limit(5)->get(),
            'weeks' => Week::last(5)->latest('week_starts_at')->withCount('tracks')->get(),
        ]);
    }
}
