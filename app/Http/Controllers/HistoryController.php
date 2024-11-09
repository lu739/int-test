<?php

namespace App\Http\Controllers;

use App\Models\BindLog;
use Inertia\Inertia;

class HistoryController extends Controller
{
    public function __invoke()
    {
        $logs = BindLog::all();

        return Inertia::render('History', compact('logs'));
    }
}
