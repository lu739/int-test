<?php

namespace App\Services\Amo;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

interface AmoServiceInterface
{
    public function getLeads(): JsonResponse;

    public function addContact(array $formData): JsonResponse|Throwable;

    public function addNoteToContact(string $note, int $contact_id): JsonResponse|Throwable;

    public function bindContactToLead(Request $request): JsonResponse;

    public function getLeadContacts(int $lead_id): JsonResponse;
}
