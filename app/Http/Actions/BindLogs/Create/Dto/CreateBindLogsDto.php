<?php

namespace App\Http\Actions\BindLogs\Create\Dto;

class CreateBindLogsDto
{
    public function __construct(
        private string $leadId,
        private string $message,
        private ?string $log,
        private bool   $isSuccess,
    ) {
    }


    public static function fromResponse(array $responseData, int $lead_id): self
    {
        return new self(
            leadId: (string)$lead_id,
            message: $responseData['message'] ?? '',
            log: $responseData['log'] ?? null,
            isSuccess: isset($responseData['log']) ? false : true,
        );
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    public function setIsSuccess(bool $isSuccess): self
    {
        $this->isSuccess = $isSuccess;
        return $this;
    }

    public function getLeadId(): string
    {
        return $this->leadId;
    }

    public function setLeadId(string $leadId): self
    {
        $this->leadId = $leadId;
        return $this;
    }

    public function getLog(): ?string
    {
        return $this->log;
    }

    public function setLog(?string $log): self
    {
        $this->log = $log;
        return $this;
    }
}
