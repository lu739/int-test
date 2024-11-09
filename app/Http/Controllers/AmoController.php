<?php

namespace App\Http\Controllers;

use App\Services\Amo\AmoServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AmoController extends Controller
{
    public function __construct(
        private AmoServiceInterface $amoService
    ) {
    }
    private function makeApiPostRequest($endpoint, $data = [])
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . env('AMO_CRM_TOKEN'),
            'Content-Type' => 'application/json',
        ])->post(env('AMO_CRM_HOST') . 'api/v4/' . $endpoint, $data);
    }

    public function getLeads()
    {
        $this->amoService->getLeads();
    }

    public function addContact(Request $request): JsonResponse
    {
        $formData = [
            [
                'name' => $request->input('contact.name'),
                'custom_fields_values' => [
                    [
                        "field_name" => "Телефон",
                        "field_code" => "PHONE",
                        "field_type" => "multitext",
                        "values" => [
                            [
                                "value" => $request->input('contact.phone')
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $this->amoService->addContact($formData);
    }

    public function bindContactToLead(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lead_id' => 'required|integer',
            'contact' => 'required|array',
            'contact.name' => 'required|string',
            'contact.phone' => 'required|string',
            'contact.comment' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $this->amoService->bindContactToLead($request);
    }

    public function getContacts(int $lead_id)
    {
        $this->amoService->getLeadContacts($lead_id);
    }

}
