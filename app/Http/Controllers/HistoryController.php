<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HistoryController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('History');
    }
}
