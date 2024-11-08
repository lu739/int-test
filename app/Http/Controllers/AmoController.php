<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AmoController extends Controller
{
    public function getLeads()
    {
        dd(
            env('AMO_CRM_HOST'),
            env('CLIENT_ID'),
            env('CLIENT_SECRET'),
            env('REDIS_CLIENT'),
            env('DB_CONNECTION'),
        );
        $data = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('AMO_CRM_TOKEN')
        ])->get(env('AMO_CRM_HOST').'api/v4/leads');

        return response()->json([
            'data' => $data->json()
        ]);
    }
}
