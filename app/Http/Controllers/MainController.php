<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Main', [
            'amoCrmHost' => env('AMO_CRM_HOST'),
            'amoCrmToken' => env('AMO_CRM_TOKEN'),
        ]);
    }
}
