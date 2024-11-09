<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AmoController extends Controller
{
    private function makeApiRequest($endpoint)
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . env('AMO_CRM_TOKEN')
        ])->get(env('AMO_CRM_HOST') . 'api/v4/' . $endpoint);
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
        $data = $this->makeApiRequest('leads?with=contacts&order[created_at]=desc');

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
    public function getEventTypes()
    {
        $data = $this->makeApiRequest('events/types');

        return response()->json([
            'data' => $data->json()
        ]);
    }

    public function addContact(Request $request): JsonResponse|\Throwable
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

        try {
            $data = $this->makeApiPostRequest('contacts', $formData);
        } catch (\Throwable $th) {
            return $th;
        }

        return response()->json([
            'data' => $data->json()
        ]);
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

        $addContactResponse = $this->addContact($request);

        if ($addContactResponse instanceof \Throwable) {
            return response()->json([
                'success' => false,
                'errors' => 'Не удалось добавить контакт',
            ], 422);
        }

        $contact = json_decode($addContactResponse->getContent(), true)['data']['_embedded']['contacts'][0] ?? null;

        if (!$contact) {
            dump(json_decode($addContactResponse->getContent(), true));
            return response()->json([
                'success' => false,
                'errors' => 'Не удалось получить добавленный контакт',
            ], 422);
        }

        $formData = [
            [
                'to_entity_id' => $contact['id'],
                'to_entity_type' => 'contacts',
            ]
        ];

        $data = $this->makeApiPostRequest('leads/' . $request->input('lead_id') . '/link', $formData);

        return response()->json([
            'data' => $data->json()
        ]);
    }

    public function getContacts(int $lead_id)
    {
        $data = $this->makeApiRequest('leads/'.$lead_id.'/links?filter[to_entity_type]=contacts');

        return response()->json([
            'data' => $data->json()
        ]);
    }

}
