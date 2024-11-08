<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AmoController extends Controller
{
    private function makeApiRequest($endpoint)
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . env('AMO_CRM_TOKEN')
        ])->get(env('AMO_CRM_HOST') . 'api/v4/' . $endpoint);
    }

    public function getLeads()
    {
        $data = $this->makeApiRequest('leads');

        return response()->json([
            'data' => $data->json()
        ]);
    }

    public function getEvents()
    {
        $data = $this->makeApiRequest('events');

        return response()->json([
            'data' => $data->json()
        ]);
    }

}
