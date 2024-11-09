<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class BindContactController extends Controller
{
    public function __invoke(int $lead_id)
    {
        return Inertia::render('BindContact', [
            'leadId' => $lead_id
        ]);
    }
}
