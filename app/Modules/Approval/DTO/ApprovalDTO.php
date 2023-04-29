<?php

declare(strict_types=1);

namespace App\Modules\Approval\DTO;

use App\Domain\Enums\StatusEnum;
use Ramsey\Uuid\UuidInterface;

final readonly class ApprovalDTO
{
    /** @param class-string $entity */
    public function __construct(
        public UuidInterface $id,
        public StatusEnum $status,
        public string $entity,
    ) {
    }
}
