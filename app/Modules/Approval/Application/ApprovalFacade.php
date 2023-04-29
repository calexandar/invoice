<?php

declare(strict_types=1);

namespace App\Modules\Approval\Application;

use App\Domain\Enums\StatusEnum;
use App\Modules\Invoices\Infrastructure\Exceptions\ApprovalStatusAlreadyRegistered;
use App\Modules\Invoices\Infrastructure\InvoiceRepository;
use Illuminate\Contracts\Events\Dispatcher;
use LogicException;
use App\Modules\Approval\ApprovalFacadeInterface;
use App\Modules\Approval\DTO\ApprovalDTO;
use App\Modules\Approval\Events\InvoiceApproved;
use App\Modules\Approval\Events\InvoiceRejected;

final readonly class ApprovalFacade implements ApprovalFacadeInterface
{
    public function __construct(
        private Dispatcher $dispatcher,
        private InvoiceRepository $invoiceRepository,
    ) {
    }

    public function approve(ApprovalDTO $dto): true
    {
        $this->validate($dto);
        $this->invoiceRepository->updateStatus($dto, StatusEnum::APPROVED);
        $this->dispatcher->dispatch(new InvoiceApproved($dto));

        return true;
    }

    public function reject(ApprovalDTO $dto): true
    {
        $this->validate($dto);
        $this->invoiceRepository->updateStatus($dto, StatusEnum::REJECTED);
        $this->dispatcher->dispatch(new InvoiceRejected($dto));

        return true;
    }

    private function validate(ApprovalDTO $dto): void
    {
        if (StatusEnum::DRAFT !== StatusEnum::tryFrom($dto->status->value)) {
            throw new ApprovalStatusAlreadyRegistered('approval status is already assigned');
        }
    }
}
