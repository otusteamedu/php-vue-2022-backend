<?php

declare(strict_types=1);

namespace App\Api\Application\Contract;

use App\Api\Application\Dto\Input\CreateLeadDto;
use App\Api\Application\Dto\Output\LeadIsCreatedDto;

interface CreateLeadInterface
{
    public function create(CreateLeadDto $dto): LeadIsCreatedDto;
}
