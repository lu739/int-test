<?php

namespace App\Http\Controllers;

use App\Enum\LeadTypeEnum;
use Inertia\Inertia;

class HistoryController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('History', [
            'leadTypes' => LeadTypeEnum::cases(),
        ]);
    }
}
