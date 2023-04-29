<?php

declare(strict_types=1);

namespace App\Modules\Approval;

use App\Modules\Approval\DTO\ApprovalDTO;

interface ApprovalFacadeInterface
{
    public function approve(ApprovalDTO $invoice): true;

    public function reject(ApprovalDTO $invoice): true;
}
