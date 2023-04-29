<?php
namespace App\Modules\Invoices\Infrastructure;

use App\Domain\Enums\StatusEnum;
use App\Modules\Approval\DTO\ApprovalDTO;

class InvoiceRepository {

    public function updateStatus(ApprovalDTO $approvalDto, StatusEnum $newStatus): void
    {
        // update status
    }

}
