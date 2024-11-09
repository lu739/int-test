<?php

namespace App\Http\Actions\BindLogs\Create;

use App\Http\Actions\BindLogs\Create\Dto\CreateBindLogsDto;
use App\Models\BindLog;

class CreateBindLog
{
    public function handle(CreateBindLogsDto $dto): BindLog
    {

        $bindLog = new BindLog();
        $bindLog->lead_id = $dto->getLeadId();
        $bindLog->message = $dto->getMessage();
        $bindLog->log = $dto->getLog();
        $bindLog->is_success = $dto->isSuccess();

        $bindLog->save();

        return $bindLog;
    }
}
