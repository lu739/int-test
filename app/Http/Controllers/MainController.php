<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class MainController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Main');
    }
}
