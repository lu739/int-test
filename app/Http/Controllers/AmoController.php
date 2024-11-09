<?php

namespace App\Http\Controllers;

use App\Http\Actions\BindLogs\Create\CreateBindLog;
use App\Http\Actions\BindLogs\Create\Dto\CreateBindLogsDto;
use App\Services\Amo\AmoServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AmoController extends Controller
{
    public function __construct(
        private readonly AmoServiceInterface $amoService
    ) {
    }

    public function getLeads()
    {
        return $this->amoService->getLeads();
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

        $response = $this->amoService->bindContactToLead($request);
        $data = $response->getData(true);

        $dto = CreateBindLogsDto::fromResponse(
            $data,
            $request->get('lead_id')
        );

        (new CreateBindLog)->handle($dto);

        return $response;
    }

    public function getContacts(int $lead_id)
    {
        return $this->amoService->getLeadContacts($lead_id);
    }

}
