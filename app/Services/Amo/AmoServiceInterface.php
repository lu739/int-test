<?php

namespace App\Services\Amo;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface AmoServiceInterface
{
    public function getLeads(): JsonResponse;

    public function addContact(array $formData): JsonResponse;

    public function bindContactToLead(Request $request): JsonResponse;

    public function getLeadContacts(int $lead_id): JsonResponse;
}
