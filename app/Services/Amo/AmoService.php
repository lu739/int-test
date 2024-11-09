<?php

namespace App\Services\Amo;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Throwable;

class AmoService implements AmoServiceInterface
{
    private function makeApiRequest($endpoint)
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . env('AMO_CRM_TOKEN')
        ])
            ->get(env('AMO_CRM_HOST') . 'api/v4/' . $endpoint);
    }
    private function makeApiPostRequest($endpoint, $data = [])
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . env('AMO_CRM_TOKEN'),
            'Content-Type' => 'application/json',
        ])->post(env('AMO_CRM_HOST') . 'api/v4/' . $endpoint, $data);
    }

    public function getLeads(): JsonResponse
    {
        try {
            $response = $this->makeApiRequest('leads?with=contacts&order[created_at]=desc');
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Не удалось получить данные по сделкам',
                'error' => $e,
            ]);
        }
        return response()->json([
            'data' => $response->json()
        ]);
    }

    public function addContact(array $formData): JsonResponse|Throwable
    {
        try {
            $response = $this->makeApiPostRequest('contacts', $formData);
        } catch (Throwable $th) {
            throw $th;
        }

        return response()->json([
            'data' => $response->json()
        ]);
    }

    public function addNoteToContact(string $note, int $contact_id): JsonResponse|Throwable
    {
        $formData = [[
            'note_type' => 'common',
            'params' => [
                'text' => $note
            ]
        ]];

        try {
            $response = $this->makeApiPostRequest('contacts/'. $contact_id . '/notes', $formData);
        } catch (Throwable $th) {
            throw $th;
        }

        return response()->json([
            'data' => $response->json()
        ]);
    }

    public function bindContactToLead(Request $request): JsonResponse
    {
        $formDataAddContact = [
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
            $addContactResponse = $this->addContact($formDataAddContact);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Не удалось добавить контакт по сделке '. $request->input('lead_id'),
                'log' => $e->getMessage(),
            ]);
        }

        $contact = json_decode($addContactResponse->getContent(), true)['data']['_embedded']['contacts'][0] ?? null;

        if (!$contact) {
            return response()->json([
                'message' => 'Не удалось получить контакт по сделке '. $request->input('lead_id'),
                'log' => '',
            ], 404);
        }

        try {
            $this->addNoteToContact($request->input('contact.comment'), $contact['id']);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Не удалось добавить комментарий контакту '. $contact['id'] . ' по сделке '. $request->input('lead_id'),
                'log' => $e->getMessage(),
            ]);
        }

        $formDataBindContact = [
            [
                'to_entity_id' => $contact['id'],
                'to_entity_type' => 'contacts',
            ]
        ];

        try {
            $response = $this->makeApiPostRequest('leads/' . $request->input('lead_id') . '/link', $formDataBindContact);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Не удалось привязать контакт '. $contact['id'] . ' к сделке '. $request->input('lead_id'),
                'log' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'data' => $response->json(),
            'message' => 'Успешно привязан контакт '. $contact['id'] .' к сделке ' . $request->input('lead_id'),
        ]);
    }

    public function getLeadContacts(int $lead_id): JsonResponse
    {
        try {
            $response = $this->makeApiRequest('leads/'.$lead_id.'/links?filter[to_entity_type]=contacts');
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Не удалось получить контакты',
                'error' => $e,
            ]);
        }

        return response()->json([
            'data' => $response->json()
        ]);
    }

}
