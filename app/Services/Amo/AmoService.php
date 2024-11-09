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

    public function bindContactToLead(Request $request): JsonResponse
    {
        try {
            $addContactResponse = $this->addContact((array)$request);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Не удалось добавить контакт',
                'error' => $e,
            ]);
        }

        $contact = json_decode($addContactResponse->getContent(), true)['data']['_embedded']['contacts'][0] ?? null;

        if (!$contact) {
            return response()->json([
                'success' => false,
                'errors' => 'Не удалось получить добавленный контакт',
            ], 404);
        }

        $formData = [
            [
                'to_entity_id' => $contact['id'],
                'to_entity_type' => 'contacts',
            ]
        ];

        try {
            $response = $this->makeApiPostRequest('leads/' . $request->input('lead_id') . '/link', $formData);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Не удалось привязать контакт к сделке',
                'error' => $e,
            ]);
        }

        return response()->json([
            'data' => $response->json()
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
